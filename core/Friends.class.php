<?php

class Friends {

    private $_db;

    /**
     *  __construct
     *
     * This function get single connection to a database and put it in $this->_db
     *
     * @no param needed
     * @no return
     */
    public function __construct () {
        $this->_db = DB::getInstance();
    }

    /**
     * Create a new friend request
     * @param $user_id
     * @param $friend_id
     * @return bool|mysqli_result
     */
    public function addFriend($user_id, $friend_id) {
        $result = $this->_db->query("SELECT 1 FROM friend_request WHERE user_id={$friend_id} AND user_friend_id={$user_id} LIMIT 1");
        $friend_req = mysqli_fetch_assoc($result);
        if ($friend_req) {
            // Accept
            $this->_db->query("INSERT INTO friends (user_id, user_friend_id, friendship_created) VALUES ({$user_id}, {$friend_id}, CURRENT_TIME())");
            $this->_db->query("INSERT INTO friends (user_id, user_friend_id, friendship_created) VALUES ({$friend_id}, {$user_id}, CURRENT_TIME())");
        } else {
            // Send friend request
            $this->_db->query("INSERT INTO friend_request (user_id, user_friend_id, request_created) VALUES ({$user_id}, {$friend_id}, CURRENT_TIME())");
        }
        return true;
    }

    /**
     * Delete friend friend (+request if exists)
     * @param $user_id
     * @param $friend_id
     * @return bool
     */
    public function deleteFriend($user_id, $friend_id) {
        $this->_db->query("DELETE FROM friend_request WHERE (user_id={$user_id} AND user_friend_id={$friend_id}) OR (user_id={$friend_id} AND user_friend_id={$user_id})");
        $this->_db->query("DELETE FROM friends WHERE (user_id={$user_id} AND user_friend_id={$friend_id} OR user_id={$friend_id} AND user_friend_id={$user_id})");
        return true;
    }

    /**
     * Delete an array of users (accepts user IDs)
     * @param $user_id
     * @param $friends_to_remove
     * @return bool
     */
    public function deleteFriends($user_id, $friends_to_remove) {
        foreach ($friends_to_remove as $friend_id) {
            $this->_db->query("DELETE FROM friends WHERE (user_id={$user_id} AND user_friend_id={$friend_id} OR user_id={$friend_id} AND user_friend_id={$user_id})");
        }
        return true;
    }

    /**
     *  getAllFriends
     *
     * This function returns an array of all friends ID for the user.
     *
     * @param (int) ( $id ) The ID of the user asks his friend list
     * @param int $limit
     * @return array ( $friends ) num array with friends ID
     */
    public function getAllFriends( $id, $limit = 99999 ){
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM ((SELECT " . TBL_USERS_INFO . ".* FROM friends INNER JOIN " . TBL_USERS_INFO . " ON friends.user_friend_id=" . TBL_USERS_INFO . ".user_id WHERE friends.user_id = $id)
				UNION (SELECT " . TBL_USERS_INFO . ".* FROM friends INNER JOIN " . TBL_USERS_INFO . " ON friends.user_id=" . TBL_USERS_INFO . ".user_id WHERE friends.user_friend_id = $id)) AS tmp LIMIT $limit";

        $results = $this->_db->query($query);
        $count = $this->_db->query('SELECT FOUND_ROWS() AS count');
        $friends = array();

        while ( $row = $results->fetch_assoc() ){
            $friends[] = $row;
        }

        return ['count' => $count->fetch_assoc()['count'], 'friends' => $friends];
    }

    /**
     * Get friend status (is friend request sent / is friend?)
     * @param $user_id
     * @param $friend_id
     * @return mixed
     */
    public function getFriendStatus($user_id, $friend_id) {
        $result = $this->_db->query("SELECT 1 FROM friends WHERE user_id={$user_id} AND user_friend_id={$friend_id} LIMIT 1");
        $is_friend = mysqli_fetch_assoc($result);
        $result = $this->_db->query("SELECT 1 FROM friend_request WHERE user_id={$user_id} AND user_friend_id={$friend_id} LIMIT 1");
        $friend_req = mysqli_fetch_assoc($result);
        $status['is_friend'] = $is_friend;
        $status['is_friend_req_sent'] = !$is_friend && $friend_req;
        return $status;
    }

    /**
     * Get all friend requests for a user
     * @param $user_id
     * @return array
     */
    public function getFriendRequests($user_id) {
        $query = "
          SELECT * FROM friend_request
          LEFT JOIN friends ON friend_request.user_friend_id=friends.user_friend_id
          INNER JOIN users_info ON friend_request.user_id=users_info.user_id
          WHERE friend_request.user_friend_id={$user_id} AND friends.user_id IS NULL";
        $result = $this->_db->query($query);
        $friend_requests = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $friend_requests[] = $row;
        }
        return $friend_requests;
    }

    /**
     * Get user's notifications (friend request received, friend added, someone commented or liked on my post)
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getNotifications($offset = 0, $limit = 10) {
        $user_id = $_SESSION['auth']['user_id'];
        $sql_request_sent = "
            SELECT friend_request.user_id AS friend_id, CONCAT(user_firstname, ' ', user_lastname) AS full_name, user_profile_picture, 'request_sent' AS type, request_created AS date, NULL AS post_id
            FROM friend_request
            INNER JOIN users_info ON friend_request.user_id=users_info.user_id
            WHERE friend_request.user_friend_id={$user_id}";
        $sql_friend_added = "
            SELECT friends.user_friend_id AS friend_id, CONCAT(user_firstname, ' ', user_lastname) AS full_name, user_profile_picture, 'friend_added' AS type, friendship_created AS date, NULL AS post_id
            FROM friends
            INNER JOIN users_info ON friends.user_friend_id=users_info.user_id
            WHERE friends.user_id={$user_id}";

        $sql_post_commented = "
            SELECT comments.user_id AS friend_id, CONCAT(user_firstname, ' ', user_lastname) AS full_name, user_profile_picture, 'post_commented' AS type, comment_time AS date, comments.post_id AS post_id
            FROM comments
            INNER JOIN posts ON comments.post_id=posts.post_id
            INNER JOIN users_info ON comments.user_id=users_info.user_id
            WHERE posts.user_id={$user_id} AND comments.user_id!={$user_id}";

        $sql_post_liked = "
            SELECT likes.user_id AS friend_id, CONCAT(user_firstname, ' ', user_lastname) AS full_name, user_profile_picture, 'post_liked' AS type, like_created AS date, likes.post_id AS post_id
            FROM likes
            INNER JOIN posts ON likes.post_id=posts.post_id
            INNER JOIN users_info ON likes.user_id=users_info.user_id
            WHERE posts.user_id={$user_id} AND likes.user_id!={$user_id}";

        $result = $this->_db->query("SELECT * FROM ({$sql_request_sent} UNION {$sql_friend_added} UNION {$sql_post_commented} UNION {$sql_post_liked}) AS tmp ORDER BY date DESC LIMIT {$offset}, {$limit}");
        $notifications = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notifications[] = $row;
        }
        return $notifications;
    }
};