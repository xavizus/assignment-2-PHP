<?php
session_start();

echo 'Welcome ' . $_SESSION['username'];
echo "<br>";
echo 'Your email is ' . $_SESSION['email'];


?>

<h1> Success</h1>

<!-- require 'include/header.php';
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
</div>

<?php require 'include/footer.php';?> -->

