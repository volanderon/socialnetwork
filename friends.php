<?php

require_once 'inc/bootstrap.inc.php';
require_once 'inc/guard.inc.php';

// Users model
require_once dirname( __FILE__ ) . '/core/Users.class.php';
$usersModel = new User();

// Friends model
require_once dirname( __FILE__ ) . '/core/Friends.class.php';
$friendsModel = new Friends();

// Get viewed user
$viewedUser = $usersModel->getUserById((int)$_GET['user_id']);

// Get friends
$friendsAll = $friendsModel->getAllFriends($viewedUser['user_id'])['friends'];

// Get friends
$friends = $friendsModel->getAllFriends($viewedUser['user_id'], 6);
shuffle($friends['friends']);

$page['friends_box_title'] = 'Friends';

require_once 'templates/friends.tpl.php';