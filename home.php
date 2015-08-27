<?php

require_once 'inc/bootstrap.inc.php';
require_once 'inc/guard.inc.php';

// Friends model
require_once dirname( __FILE__ ) . '/core/Friends.class.php';
$friendsModel = new Friends();

// Posts model
require_once dirname( __FILE__ ) . '/core/Post.class.php';
$postsModel = new Post();

// Get friends
$friends = $friendsModel->getAllFriends($_SESSION['auth']['user_id'], 6);
shuffle($friends['friends']);

// Get posts
$posts = $postsModel->showFirstPosts();


require_once 'templates/home.tpl.php';