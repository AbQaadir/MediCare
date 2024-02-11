<?php
include_once 'config/config-session.php';
include_once 'config/views/register.view.php';


require_once 'config/components/input.component.php';
require_once 'config/components/button.component.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css"> -->
    <link rel="stylesheet" href="style/login.css">
    <title>Register Page</title>

</head>

<body>
    <div class="container">
        <h1 class="text-center">Registration Page</h1>
        <form action="config/user-register.inc.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <?php generateInput("text", "name", "name" ); ?>


                <?php checkNameError(); ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <?php generateInput("email", "email", "email" ); ?>

                <?php checkEmailError(); ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <?php generateInput("tel", "phone", "phone" ); ?>

                <?php checkPhoneError(); ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <?php generateInput("password", "password", "password"); ?>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Repeat Password</label>
                <?php generateInput("password", "password_confirmation", "password_confirmation"); ?>
                <?php checkPasswordError(); ?>
            </div>
            <?php generateButton("Register", "register"); ?>

            <?php
            unset($_SESSION['errorsRegister']);
            unset($_SESSION['registerData']);
            ?>
        </form>
        <p class="text-center">Already a member? <a href="login.php">Log In</a></p>
    </div>
</body>

</html>