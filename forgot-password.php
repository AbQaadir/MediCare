<?php
    require_once 'config/config-session.php';
    require_once 'config/views/forgotpassword.view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    
    <p>Enter your email address below to recover your password:</p>
    <form method="post" action="config/forgot-password.inc.php">
        <input type="email" name="email" placeholder="Your Email" required>
        <button type="submit" name="resetPassword">Reset Password</button>
    </form>
    <?php
        checkForgotPasswordErrors();
    ?>
</body>
</html>