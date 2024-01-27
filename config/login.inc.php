<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        require_once 'db.inc.php';
        require_once 'models/login.model.php';
        require_once 'controllers/login.contr.php';

        $errors = array();

        if (isEmptyEmail($email)) {
            $errors["empty_email"] = 'Email is required';
        } else if (!isValidEmail($email)) {
            $errors["invalid_email"] = 'Email is invalid';
        }

        if (isEmptyPassword($password)) {
            $errors["empty_password"] = 'Password is required';
        }

        $userType = getUserType($pdo, $email);

        if (isEmailWrong($userType)) {
            $errors["wrong_email"] = 'Incorrect Login Info!';
        } else {
            if ($userType["table_name"] === 'loginfo') {
                $result = getLoginfo($pdo, $email);
            } else if ($userType["table_name"] === 'admin') {
                $result = getAdmin($pdo, $email);
            } else if ($userType["table_name"] === 'superadmin') {
                $result = getSuperAdmin($pdo, $email);
            }
    
            if (isEmailWrong($result)) {
                $errors["wrong_email"] = 'Incorrect Login Info!';
            }
    
            if (!isEmailWrong($result) && isPasswordWrong($password, $result["password"])) {
                $errors["wrong_password"] = 'Incorrect Login Info!';
            }
        }

        require_once 'config-session.php';

        if ($errors) {
            $_SESSION['errorsLogin'] = $errors;
            header('Location: ../login.php');
            exit();
        }

        $_SESSION["userType"] = $userType["table_name"];
        $_SESSION["email"] = $result["email"];


        header("Location: ../index.php?login=success");
        $pdo = null;
        $state = null;
        exit();

    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header('Location: login.php');
    exit();
}