<?php
require_once 'header.php';
require_once 'config/config-session.php';
try {
    require_once 'config/db.inc.php';
    require_once 'config/models/profilepage.model.php';
    require_once 'config/views/profile.view.php';

    $email = $_SESSION["email"];
    $userType = $_SESSION["userType"];



    if ($email && $userType == "loginfo") {
        $result = getUser($pdo, $email);
        $name = $result["name"];
        $phone = $result["phone_number"];
        $email = $result["email"];
    } elseif ($email && $userType == "admin") {
        $result = getAdmin($pdo, $email);
        $name = $result["name"];
        $phone = $result["phone_number"];
        $email = $result["email"];
    } else {
        header("Location: login.php");
    }
} catch (PDOException $e) {
    die("Could not connect. " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>
    <div class="card">
        <?php generateProfileHTML($name, $email, $phone); ?>
    </div>
    <?php
require_once 'footer.php';
?>
</body>

</html>