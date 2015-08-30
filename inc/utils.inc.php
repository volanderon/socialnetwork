<?php

/**
 * * Shortcut function to debug variables
 * @param $var
 * @param bool $die
 */
function d($var, $die = true) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die) {
        exit;
    }
}

function get_profile_picture($pic) {
    return $pic ? 'user_content/photos/' . $pic . '?' . time() : 'images/thumbs/thumb_008.jpg';
}

function get_cover_picture($pic) {
    return $pic ? 'user_content/covers/' . $pic . '?' . time() : 'images/cover-default.jpg';
}