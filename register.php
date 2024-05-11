<?php
include "config.php";
error_reporting(0);
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
    header("location:index.php");
    exit();
}

if (isset($_POST["submit"])) {
    $_username = $_POST["username"];
    $_email = $_POST["email"];
    $_password = md5($_POST["password"]);
    $_cppassword = md5($_POST["cppassword"]);

    if ($_password == $_cppassword) {
        // Check if the email already exists
        $sql_check_email = "SELECT * FROM users WHERE email='$_email'";
        $result_check_email = mysqli_query($conn, $sql_check_email);

        if ($result_check_email->num_rows == 0) {
            // Insert new user into the database
            $sql_insert_user = "INSERT INTO users (username, email, password) VALUES ('$_username', '$_email', '$_password')";
            $result_insert_user = mysqli_query($conn, $sql_insert_user);

            if ($result_insert_user) {
                echo "<script>alert('Woow! User Registration Completed')</script>";
                // Clear form inputs
                $_username = "";
                $_POST['email'] = "";
                $_POST['password'] = "";
                $_POST['cppassword'] = "";
            } else {
                echo "<script>alert('WOWWW Something went wrong')</script>";
            }
        } else {
            echo "<script>alert('Email already exists')</script>";
        }
    } else {
        echo "<script>alert('Password not Matched')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form action="" method="POST" class="login-email">
        <p style="font-size: 2rem; font-weight: 850px;">REGISTER</p>
        <div class="input-group"><input type="text" placeholder="Username" name="username"
                                        value="<?php echo isset($_username) ? $_username : ''; ?>"></div>
        <div class="input-group"><input type="text" placeholder="Email" name="email"
                                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"></div>
        <div class="input-group"><input type="password" placeholder="Password" name="password" required></div>
        <div class="input-group"><input type="password" placeholder="Confirm Password" name="cppassword"
                                        required></div>
        <div class="input-group"><button name="submit" class="btn">Register</button></div>
        <p class="login-register-text">Have an Account ?
            <a href="index.php">Login</a>
        </p>
    </form>
</div>
</body>
</html>