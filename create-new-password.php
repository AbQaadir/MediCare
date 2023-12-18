<?php
    require_once 'config/config-session.php';
    require_once 'config/views/create.new.password.view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>
<body>
    <h1>Create New Password</h1>
    <?php
        checkForgotPasswordErrors();
    ?>
    <form action="config/create-new-password.inc.php" method="post">
        <input type="hidden" name="selector" value="<?php echo $_GET['selector']; ?>">
        <input type="hidden" name="validator" value="<?php echo $_GET['validator']; ?>">

        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" required>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>