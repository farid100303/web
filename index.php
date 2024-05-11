
<?php
include "config.php";

session_start();
error_reporting(0);

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location:welcome.php");
    exit();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST["password"]);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("location:welcome.php");
        exit();
    } else {
        echo "<script>alert('Woops! Email or Password is Incorrect')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form action="" method="POST" class="login-email">
        <p style="font-size: 2rem; font-weight: 850px;">Login</p>
        <div class="input-group"><input type="email" placeholder="Email" name="email"
                                        value="<?php echo isset($email) ? $email : ''; ?>" required></div>
        <div class="input-group"><input type="password" placeholder="Password" name="password" required></div>
        <div class="input-group"><button name="submit" class="btn">Log In</button></div>
        <p class="login-register-text">Don't Have an Account ?
            <a href="register.php">Register</a>
        </p>
    </form>
</div>
</body>
</html>