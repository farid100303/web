<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header('location:index.php');
    exit();
}
?>