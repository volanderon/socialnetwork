<?php

if (!isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit;
}