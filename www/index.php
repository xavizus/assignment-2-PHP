<h1>ff</h1>
<?php
require 'include/header.php';
session_start();

function autoload($className)
{
    $className = str_replace('\\', '/', $className);
    require dirname(__FILE__) . '/classes/' . $className . '.class.php';
}
spl_autoload_register('autoload');

?>
  <div class="row pt-4 pb-4">
    <div class="col-md-10 mx-auto">
      <div class="card card-body bg-light mt-5">

        <h2>Login elller vaddddd</h2>
        <p>Please fill in your credentials to log in</p>
        <form action="<?php echo URLROOT; ?>/user/login.php" method="post">
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg ">

          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg" >

          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Login" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/user/register.php" class="btn btn-light btn-block">No account? Register</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


<?php require 'include/footer.php';?>
