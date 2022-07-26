<?php
session_start();

$servername = "66062.m.tld.pl";
$user = "admin66062_praktykanci";
$pass = "5Ol1652RM)";
$dbname = "baza66062_praktykanci";
//establishing connection to db
$conn = new mysqli($servername, $user, $pass, $dbname);
if ($conn->connect_errno) {
    echo "<script> console.log('Connection error')</script>" . $conn->connect_error;
} else {
    echo "<script> console.log('Connected') </script>";
}
