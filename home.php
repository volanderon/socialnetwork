<?php

require_once 'inc/bootstrap.inc.php';
require_once 'inc/guard.inc.php';

require_once dirname( __FILE__ ) . '/core/Friends.class.php';
$friendsModel = new Friends();

$friends = $friendsModel->getAllFriends($_SESSION['auth']['user_id'], 6);
shuffle($friends['friends']);

require_once 'templates/home.tpl.php';