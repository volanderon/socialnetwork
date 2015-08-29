<?php

class Post{

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    /**
     * Add a new post, accepts user id and post content
     * @param $user_id
     * @param $content
     * @return mixed
     */
    public function publishPost($user_id, $content){
        $this->_db->query("INSERT INTO posts (post_id, user_id, post_content, post_created) VALUES (NULL, '$user_id', '$content', CURRENT_TIME())");
        return $this->getLastPost();
    }

    /**
     * Add a new post comment, accepts user id, post id and comment content
     * @param $user_id
     * @param $post_id
     * @param $content
     * @return mixed
     */
    public function publishComment($user_id, $post_id, $content) {
        $this->_db->query("INSERT INTO comments (comment_content, comment_time, user_id, post_id) VALUES ('$content', CURRENT_TIME(), {$user_id}, {$post_id})");
        return $this->getLastComment($post_id);
    }

    /**
     * Delete a post by user_id and post_id
     * @param $user_id
     * @param $post_id
     * @return bool|mysqli_result
     */
    public function deletePost($user_id, $post_id) {
        $post = $this->_db->query("DELETE FROM posts WHERE post_id={$post_id} AND user_id={$user_id}");
        return $post;
    }

    /**
     * Increment a post's likes counter
     * @param $user_id
     * @param $post_id
     * @return bool|mysqli_result
     */
    public function likePost($user_id, $post_id) {
        return $this->_db->query("INSERT INTO " . TBL_LIKES . " (user_id, like_created, post_id) VALUES ($user_id, CURRENT_TIME(), $post_id)");
    }

    /**
     * Decrement a post's likes counter
     * @param $user_id
     * @param $post_id
     * @return bool|mysqli_result
     */
    public function unlikePost($user_id, $post_id) {
        return $this->_db->query("DELETE FROM  " . TBL_LIKES . " WHERE user_id={$user_id} AND post_id={$post_id}");
    }

    public function getPosts($user_id, $post_id, $offset = 0, $limit = 3) {
        // TODO: use $user_id to fetch only user's posts and posts written on user's profile
        $posts = array();
        $sql = "SELECT posts.post_id, post_content, post_created, posts.user_id, user_firstname, user_lastname, user_profile_picture, GROUP_CONCAT(likes.user_id SEPARATOR '-') AS 'likes_users'
                FROM users_info
                INNER JOIN posts ON users_info.user_id=posts.user_id
                LEFT JOIN likes ON posts.post_id=likes.post_id
                WHERE posts.user_id = users_info.user_id";

        if ($post_id) {
            // Single post view
            $sql .= " AND posts.post_id={$post_id} GROUP BY posts.post_id";
            $post = $this->_db->query($sql);
            $posts[] = mysqli_fetch_assoc($post);
        } else {
            if ($user_id) {
                // User profile view
                $sql .= " AND posts.user_id={$user_id}";
            }
            $sql .= " GROUP BY posts.post_id ORDER BY posts.post_created DESC LIMIT {$offset}, {$limit}";
            $post = $this->_db->query($sql);
            while ($row = mysqli_fetch_assoc($post)) {
                $posts[] = $row;
            }
        }

        if ($posts) {
            $post_ids = [];
            foreach ($posts as $post) {
                $post_ids[] = $post['post_id'];
            }
            $likes = $this->getLikes($post_ids);
            $comments = [];
            foreach ($post_ids as $post_id) {
                $comments[$post_id] = $this->getComments($post_id);
            }
        } else {
            $likes = $comments = [];
        }

        return ['posts' => $posts, 'likes' => $likes, 'comments' => $comments];
    }

    /**
     * Get an array of comments for a list of posts
     * @param $post_id
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getComments($post_id, $offset = 0, $limit = 3) {
        $comments = [];
        $result = $this->_db->query("SELECT comments.*, user_profile_picture, CONCAT(user_firstname, ' ', user_lastname) AS full_name FROM comments " .
            "INNER JOIN users_info ON comments.user_id=users_info.user_id " .
            "WHERE post_id={$post_id} ORDER BY comment_id DESC LIMIT {$offset}, {$limit}");
        while ($row = mysqli_fetch_assoc($result)) {
            $comments[] = $row;
        }
        return array_reverse($comments);
    }

    /**
     * Get likes for an array of post ids
     * Excluding likes of current user (from session)
     * @param $post_ids
     * @return array
     */
    private function getLikes($post_ids) {
        $likes = [];
        $post_ids_str = implode(',', $post_ids);
        $result = $this->_db->query("SELECT likes.post_id, GROUP_CONCAT(users_info.user_profile_picture) AS pictures FROM likes " .
            "INNER JOIN users_info ON likes.user_id=users_info.user_id " .
            "WHERE likes.post_id IN ({$post_ids_str}) AND likes.user_id!={$_SESSION['auth']['user_id']} GROUP BY likes.post_id");
        while ($row = mysqli_fetch_assoc($result)) {
            $likes[$row['post_id']] = $row;
        }
        return $likes;
    }

    /**
     * Get post by id
     * @param $post_id
     * @return mixed
     */
    public function getPostById($post_id) {
        return $this->getPosts(null, $post_id, 0, 1);
    }

    /**
     * Get last post
     * @return mixed
     */
    private function getLastPost() {
        return $this->getPosts(null, null, 0, 1)['posts'][0];
    }

    /**
     * Get last comment on a post
     * @param $post_id
     * @return mixed
     */
    private function getLastComment($post_id) {
        $first_comment = array_pop($this->getComments($post_id));
        return [$first_comment['post_id'] => [$first_comment]];
    }
}
