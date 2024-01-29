<?php
require_once 'config/config-session.php';
try {
    require_once 'config/db.inc.php';
    require_once 'config/models/profilepage.model.php';
    require_once 'config/views/profile.view.php';

    $email = $_SESSION["email"];
    $result = getUser($pdo, $email);

    if ($result) {
        $name = $result["name"];
        $phone = $result["phone_number"];
        $email = $result["email"];
    } else {
        $name = "Abdul Qaadir";
        $phone = "1234567890";
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
</body>

</html>