<?php
require 'include/header.php';
$username = '';
$email='';
if (isset($_SESSION['username'])&&isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
}
//session_start();
echo "<br>" . "<br>" . "<br>";
echo "<h1>" . 'Welcome ' . $username . "</h1>";
echo "<br>";
echo "<h1>" . 'Your email is ' . $email. "</h1>";

?>



<!--require 'include/header.php';
session_start();
$user_check = '';
if (isset($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];
}
?>
<div class="row pt-4 pb-4">
    <div class="col-md-10 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h1>Welcome <?php echo $user_check; ?></h1>
      </div>
    </div>
</div> -->

<?php require 'include/footer.php';?> 
