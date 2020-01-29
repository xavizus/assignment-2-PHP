<?php
require 'include/header.php';
$username = '';
$email = '';
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
}

echo "<br>" . "<br>" . "<br>";
echo "<h1>" . 'Welcome ' . $username . "</h1>";
echo "<br>";
echo "<h1>" . 'Your email is ' . $email . "</h1>";

require 'include/footer.php';
