<?php
session_start();

$page_title = "password Change Update";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> password change</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <div class="container">
        <?php
          if(isset($_SESSION['status']))
          {
            ?>
            <div class="alert alert-success">
                <h5><?=$_SESSION['status']; ?></h5>
                <?php
                unset($_SESSION['status']);
          }
        ?>
      
      <form action="password-reset-code.php" method="POST">
        <div><h2>Changed Password</h2></div>
    <input type="hidden" name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
    <div class="form-group">
        <label>Email Address</label>
        <input type="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" placeholder="Enter Email :" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label>New password</label>
        <input type="password" placeholder="Enter new password :" name="new_password" class="form-control">
    </div>
    <div class="form-group">
        <label>Confirm password</label>
        <input type="password" placeholder="Confirm password :" name="confirm_password" class="form-control">
    </div>
    <div class="form-btn">
        <input type="submit" value="Reset Password" name="password_reset_link" class="btn btn-primary w-100">
    </div>
</form>

    </div>
</body>
</html>