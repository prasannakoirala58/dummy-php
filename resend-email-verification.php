<?php
session_start();
include('database.php'); // This file should define and set up $con

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure this path is correct

function send_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Uncomment for debugging

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dikshyak966@gmail.com';
        $mail->Password   = 'blackblack##9922'; // Use an app-specific password if needed
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('dikshyak966@gmail.com', $get_name);
        $mail->addAddress($get_email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset password notification';
        $mail->Body    = "
            <h2>Hello</h2>
            <h3>You are receiving this email because we received a password reset request for your account.</h3>
            <br/><br/>
            <a href='http://localhost/login_register/password-change.php?token=$token&email=$get_email'>Click Me</a>
        ";


        $mail->send();
        echo 'Verification email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['resend_email_verification'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $check_email = "SELECT email, name, verify_token FROM users WHERE email ='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $name = $row['name'];
        $email = $row['email'];
        $token = $row['verify_token'];

        resend_verification_email($name, $email, $token);
        $_SESSION['status'] = 'Verification email has been resent';
        header("Location: password-reset-code.php"); // Redirect to an appropriate page
        exit(0);
    } else {
        $_SESSION['status'] = 'No Email Found';
        header("Location: password-reset-code.php"); // Redirect to an appropriate page
        exit(0);
    }
}
?>
