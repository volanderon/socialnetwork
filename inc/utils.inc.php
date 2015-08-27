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