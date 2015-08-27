<?php

class Post{

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }


    public function publishPost($user_id, $content){
        $post = $this->_db->query("INSERT INTO posts (post_id, user_id, post_content, post_created) VALUES (NULL, '$user_id', '$content', CURRENT_TIME())");
        return $post;
    }

    //this functions selects all the post info PLUS joins the users_info table in order to also fetch the name of the user who made the post
    //note: this still isn't filtering by friends!
    //LIMITING POSTS will be used via "LIMIT" and "OFFSET" (skips to next x number of posts)
    //ORDER BY puts latest posts on top
    public function showFirstPosts(){
        $post = $this->_db->query("
					SELECT posts.post_id, posts.post_content, posts.post_created, posts.user_id, user_firstname, user_lastname, user_profile_picture
					FROM users_info INNER JOIN posts WHERE posts.user_id = users_info.user_id ORDER BY posts.post_created DESC LIMIT 3;
					");
        $posts = array();
        while ($row = mysqli_fetch_assoc ($post))
            $posts[] = $row;
        return $posts;
    }

    //trying to figure out how to keep showing the next posts, taking a break for now cause i'm going to sleep!!! ^_^
    public function showMorePosts($offset){
        $post = $this->_db->query("
					SELECT posts.post_id, posts.post_content, posts.post_created, posts.user_id, users_info.user_firstname, users_info.user_lastname FROM users_info INNER JOIN posts WHERE posts.user_id = users_info.user_id ORDER BY posts.post_created DESC LIMIT 3 OFFSET " . $offset . ";
					");
        $posts = array();
        while ($row = mysqli_fetch_assoc ($post))
            $posts[] = $row;
        return $posts;
    }
}
