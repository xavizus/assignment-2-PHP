<?php

if (!defined('ROOT_DIR')) {
    define("ROOT_DIR", __DIR__ . "/../../");
}
// URL Root
define('URLROOT', (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . '');
// Site Name
define('SITENAME', 'Grupp_H_PHP');
