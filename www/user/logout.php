<?php

include '../include/config.php';
require '../classes/settings.class.php';
include '../classes/Database.class.php';
include '../classes/User.php';


$database = new Database(new \Settings());
$user = new classes\User($database);

$user->logout();
