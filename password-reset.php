<?php
session_start();

$page_title = "Password Reset Form";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION['status'])) {
            ?>
            <div class="alert alert-success">
                <h5><?= $_SESSION['status']; ?></h5>
            </div>
            <?php
            unset($_SESSION['status']);
        }
        ?>

        <form action="password-reset-code.php" method="post">
            <div><h2> Password Reset</h2></div>
            <div class="form-group">
                <input type="email" placeholder="Enter Email :" name="email" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Send Password Reset Link" name="password_reset_link" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
