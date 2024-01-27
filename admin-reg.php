<?php
include_once 'config/config-session.php';
include_once 'config/views/admin.reg.view.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Admin Register Page</title>
    <!-- <style>
        Add any additional styles here
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h3 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }
    </style> -->
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin</h1>
        <h3>Register Page</h3>
        <form action="config/admin-reg.inc.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control col-md-5 mx-auto" name="name" id="name" placeholder="Name" value="<?php echo isset($_POST['submit']) ? $name : ''; ?>">
                <?php checkNameError(); ?>
            </div>
            <div class="form-group">
                <input type="email" class="form-control col-md-5 mx-auto" name="email" id="email" placeholder="Email" value="<?php echo isset($_POST['submit']) ? $email : ''; ?>">
                <?php checkEmailError(); ?>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control col-md-5 mx-auto" name="phone" id="phone" placeholder="+94770011000" value="<?php echo isset($_POST['submit']) ? $phone : ''; ?>">
                <?php checkPhoneError(); ?>
            </div>
            <div class="form-group">
                <input type="password" class="form-control col-md-5 mx-auto" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control col-md-5 mx-auto" name="password_confirmation" id="password_confirmation" placeholder="Repeat-Password">
                <?php checkPasswordError(); ?>
            </div>
            <div class="form-group col-md-5 mx-auto">
                <button type="submit" class="btn btn-primary col-md-5 mx-auto">Register Admin</button>
            </div>
        </form>
        <script>
            <?php
            if (isset($_SESSION['errorsRegisterAdmin']['used_email_loginfo'])) {
                echo "alert('Email already exists!')";
            }
            ?>
        </script>
        <?php
        unset($_SESSION['errorsRegisterAdmin']);
        unset($_SESSION['registerDataAdmin']);
        ?>
    </div>
</body>

</html>