<h1>Login</h1>

<?php

include '../include/header.php';
require '../classes/settings.class.php';
include '../classes/Database.class.php';
include '../classes/User.php';

$data = [
    'email' => '',
    'password' => '',
    'email_err' => '',
    'password_err' => '',
];

if (isset($_POST['submit'])) {
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
        //email not found
    }
    // Validate Password
    if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
    } elseif (strlen($data['password']) < 6) {
        //password not found
        $data['password_err'] = 'Password must be at least 6 characters';
    }

    if (empty($data['email_err']) && empty($data['password_err'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        echo var_dump($data);
        $user = new User();
        $user->register($data);
        //$user->validate($data);
    }
}
