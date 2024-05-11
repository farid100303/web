<?php
$server = 'localhost';
$user = "root";
$pass = "";
$database = "data_project";

$conn = mysqli_connect($server, $user, $pass, $database);
if (!isset($conn)) {
    die("<script>alert('Connection failed')</script>");
}
?>