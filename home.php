<?php

require_once 'inc/bootstrap.inc.php';
require_once 'inc/guard.inc.php';

// Friends model
require_once dirname( __FILE__ ) . '/core/Friends.class.php';
$friendsModel = new Friends();

// Get friends
$friends = $friendsModel->getAllFriends($_SESSION['auth']['user_id'], 6);
shuffle($friends['friends']);

// Get friend requests
$friendRequests = $friendsModel->getFriendRequests($_SESSION['auth']['user_id']);

require_once 'templates/home.tpl.php';