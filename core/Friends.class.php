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
            $this->_db->query("DELETE FROM friend_request WHERE (user_id={$user_id} AND user_friend_id={$friend_id}) OR (user_id={$friend_id} AND user_friend_id={$user_id})");
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
        $this->_db->query("DELETE FROM friend_request WHERE user_id={$user_id} AND user_friend_id={$friend_id}");
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
        $status['is_friend_req_sent'] = $friend_req;
        return $status;
    }

    /**
     * Get all friend requests for a user
     * @param $user_id
     * @return array
     */
    public function getFriendRequests($user_id) {
        $query = "SELECT * FROM friend_request INNER JOIN users_info ON friend_request.user_id=users_info.user_id WHERE friend_request.user_friend_id={$user_id}";
        $result = $this->_db->query($query);
        $friend_requests = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $friend_requests[] = $row;
        }
        return $friend_requests;
    }
};