<?php
session_start();

$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "users";
//establishing connection to db
$conn = new mysqli($servername, $user, $pass, $dbname);
if ($conn->connect_errno) {
    echo "<script> console.log('Connection error')</script>" . $conn->connect_error;
} else {
    echo "<script> console.log('Connected') </script>";
}
