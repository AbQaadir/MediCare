<?php

    require_once 'config/config-session.php';
    require_once 'config/views/login.view.php';

if (isset($_POST['add'])) {
    $_SESSION["p_id"] =$_POST['product_id'];}

    if(isset($_SESSION["p_id"])){ 
        $id_P = $_SESSION["p_id"];

       }
   
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
        <form action="config/login.inc.php" method="POST">
            <div class="form-group">
                <input type="email" class="form-control col-md-5 mx-auto" name="email" id="email" placeholder="Email">
                <?php checkEmailError(); ?>
            </div>
            <div class="form-group">
                <input type="password" class="form-control col-md-5 mx-auto" name="password" id="password" placeholder="Password">
                <?php checkPasswordError(); ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block col-md-5 mx-auto">Login</button>
        </form>
        <p class="text-center">Remember your password? <a href="forgot-password.php">Forgot password</a></p>
        <p class="text-center">Don't have an account? <a href="user-register.php">Sign Up</a></p>
        <?php unset($_SESSION['errorsLogin']); ?>
    </div>
</body>

</html>
