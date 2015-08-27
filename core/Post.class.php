<?php

class Post{

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function publishPost($user_id, $content){
        $this->_db->query("INSERT INTO posts (post_id, user_id, post_content, post_created) VALUES (NULL, '$user_id', '$content', CURRENT_TIME())");
        return $this->getLastPost();
    }

    public function deletePost($user_id, $post_id) {
        $post = $this->_db->query("DELETE FROM posts WHERE post_id={$post_id} AND user_id={$user_id}");
        return $post;
    }

    public function getPosts($user_id, $offset = 0, $limit = 3){
        $post = $this->_db->query("
					SELECT posts.post_id, posts.post_content, posts.post_created, posts.user_id, user_firstname, user_lastname, user_profile_picture
					FROM users_info INNER JOIN posts WHERE posts.user_id = users_info.user_id ORDER BY posts.post_created DESC LIMIT {$offset}, {$limit};
					");
        $posts = array();
        while ($row = mysqli_fetch_assoc ($post))
            $posts[] = $row;
        return $posts;
    }

    public function getLastPost() {
        return $this->getPosts(null, 0, 1)[0];
    }
}
