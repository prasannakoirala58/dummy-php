<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <div class="container">
        <div><h2>Login Form</h2></div>
        <?php
        if (isset($_POST["login"])) {
            require_once "database.php"; // Ensure this line is present
            if (isset($con)) { // Check if $con is set
                $email = $_POST["email"];
                $password = $_POST["password"];
                $sql = "SELECT * FROM users WHERE email = ?";
                
                $stmt = $con->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user"] = "yes";
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
                
                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Database connection failed</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
         
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
                <a href="password-reset.php" class="float-end"> Forget Your Password?</a>
            </div>
        </form>
        <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
        <hr>
        <h5>
            Did not receive your Verification Email?
            <a href="resend-email-verification.php">Resend</a>
        </h5>
    </div>
</body>
</html>

