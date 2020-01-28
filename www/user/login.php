

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
    } 
    // elseif ($data['email'] !== $data['email']) {
    //     //email not found
    //     $data['email_err'] = 'Email not found';
    // }
        
    // Validate Password
    if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
    }
    //  elseif ($data['password'] !== $data['password']) {
    //     //funkar ej
    //     $data['password_err'] = 'Password not found';
    // }

    if (empty($data['email_err']) && empty($data['password_err'])) {
        // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $database = new Database(new \Settings());
        $user = new classes\User($database);
        $isValidated =  $user->validate($data);
        if ($isValidated)
        {
            header('Location: /success.php');
        }
        if ($data['email'] !== $data['email' ]);
        {
            $data['email_err'] = 'Email not found';
        }
        if ($data['password'] !== $data['password' ]);
        {
            $data['password_err'] = 'Password not found';
        }
    }
}
?>

<div class="row pt-4 pb-4">
    <div class="col-md-10 mx-auto">
      <div class="card card-body bg-light mt-5">

        <h2>Login</h2>
        <p>Please fill in your credentials to log in</p>
        <form action="<?php echo URLROOT; ?>/user/login.php" method="post">
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" >
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>

          </div>
          <div class="row">
            <div class="col">
              <input type="submit" name="submit" value="Login" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/user/register.php" class="btn btn-light btn-block">No account? Register</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>