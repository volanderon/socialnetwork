<?php

require_once 'inc/bootstrap.inc.php';
require_once 'inc/guard.inc.php';

require_once dirname( __FILE__ ) . '/core/Friends.class.php';
$friends = new Friends();

$friends_arr = $friends->getAllFriends($_SESSION['auth']['user_id']);

require_once 'templates/home.tpl.php';