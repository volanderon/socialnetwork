<?php

require_once 'inc/bootstrap.inc.php';

if (isset($_SESSION['auth'])) {
    header('Location: home.php');
    exit;
}

require_once 'templates/index.tpl.php';