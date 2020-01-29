<?php

include '../include/config.php';
require '../classes/settings.class.php';
include '../classes/Database.class.php';
include '../classes/User.php';

// Init data
$data = [
    'email' => trim($_POST['email']),
    'password' => trim($_POST['password']),
    'email_err' => '',
    'password_err' => '',
];
// Validate Email
if (empty($data['email'])) {
    $data['email_err'] = 'Please enter email';
}

// Validate Password
if (empty($data['password'])) {
    $data['password_err'] = 'Please enter password';
}

if (empty($data['email_err']) && empty($data['password_err'])) {
    $database = new Classes\Database(new Classes\Settings());
    $user = new Classes\User($database);
    $isValidated =  $user->validate($data);

    if ($isValidated) {
        $_SESSION['username'] = $isValidated->username;
        $_SESSION['email'] = $data['email'];
        header('Location: /success.php');
    } else {
        header('Location: /index.php?msg_err=Det gick inte att logga in');
    }
}
