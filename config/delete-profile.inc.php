<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    try {
        require_once 'db.inc.php';
        require_once 'models/profilepage.model.php';

        $userType = $_SESSION['userType'];


        if ($email && $userType == 'loginfo') {
            deleteUser($pdo, $email);
            header('Location: index.php');
        } elseif ($email && $userType == 'admin') {
            deleteAdmin($pdo, $email);
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
    } catch (PDOException $e) {
        die('Could not connect. ' . $e->getMessage());
    }
}
