<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "test";

$con = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($con->connect_error) {
    die("Something went wrong: " . $con->connect_error);
}
?>