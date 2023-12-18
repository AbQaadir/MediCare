<?php
include_once 'config/config-session.php';
include_once 'config/views/register.view.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Register Page</title>
    <!-- <style>
        /* style.css */

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .btn-block {
            width: 100%;
        }

        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        /* Add this to your existing style.css or create a new one */

        /* Error message styling */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #f00;
            border-radius: 5px;
            color: #f00;
            background-color: #ffd2d2;
        }

        .alert ul {
            list-style-type: none;
            padding: 0;
        }

        .alert li {
            margin-left: 20px;
        }
    </style>  -->
</head>

<body>
    <div class="container">
        <h1 class="text-center">Registration Page</h1>
        <form action="config/user-register.inc.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php if (isset($_POST['submit'])) {
                                                                                                            echo $name;
                                                                                                        } ?>">
                <?php checkNameError(); ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php if (isset($_POST['submit'])) {
                                                                                                                echo $email;
                                                                                                            } ?>">
                <?php checkEmailError(); ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="+94770011000" value="<?php if (isset($_POST['submit'])) {
                                                                                                                        echo $phone;
                                                                                                                    } ?>">
                <?php checkPhoneError(); ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Repeat Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repeat Password">
                <?php checkPasswordError(); ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <?php
            unset($_SESSION['errorsRegister']);
            unset($_SESSION['registerData']);
            ?>
        </form>
        <p class="text-center">Already a member? <a href="login.php">Log In</a></p>
    </div>
</body>

</html>