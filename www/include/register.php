
<?php
include 'header.php';
require '../classes/settings.class.php';
include '../classes/Database.php';

$data = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'username_err' => '',
    'email_err' => '',
    'password_err' => '',
    'confirm_password_err' => '',
];

if (isset($_POST['submit'])) {
    // Init data
    $data = [
        'username' => trim($_POST['username']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'username_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => '',
    ];
    // Validate Name
    if (empty($data['username'])) {
        $data['username_err'] = 'Pleae enter username';
    }
    // Validate Email
    if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter email';
    }
    // Validate Password
    if (empty($data['password'])) {
        $data['password_err'] = 'Pleae enter password';
    } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
    }

    // Validate Confirm Password
    if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Pleae confirm password';
    } else {
        if ($data['password'] != $data['confirm_password']) {
            $data['confirm_password_err'] = 'Passwords do not match';
        }
    }

    if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        echo var_dump($data);
        register($data);
    }
}

function register($data)
{
    $config = new \Settings();
    $db = new Database($config->getDatabaseConfig());
    $db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

    // Bind values
    $db->bind(':username', $data['username']);
    $db->bind(':email', $data['email']);
    $db->bind(':password', $data['password']);
    // Execute
    if ($db->execute()) {
        return true;
    } else {
        return false;
    }
}

?>


  <div class="row pt-4 pb-4">
    <div class="col-md-10 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Create An Account</h2>
        <p>Please fill out this form to register</p>
        <form action="register.php" method="POST">
          <div class="form-group">
            <label for="name">Username: <sup>*</sup></label>
            <input type="text" name="username" class="form-control form-control-lg <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" ">
            <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" ">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>"">
            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" name="submit"  value="Register" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>" class="btn btn-light btn-block">Have an account? Login</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php include 'footer.php';?>