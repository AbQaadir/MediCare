<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    try {
        require_once 'db.inc.php';
        require_once 'models/admin.reg.model.php';
        require_once 'controllers/admin.reg.contr.php';

        
        $errors = array();

        // check that input fields are empty and valid
        if (isEmptyName($name)) {
            $errors["empty_name"] = 'Name is required';
        } elseif (!isValidName($name)) {
            $errors["invalid_name"] = 'Name must be between 3 and 255 characters';
        }

        if (isEmptyEmail($email)) {
            $errors["empty_email"] = 'Email is required';
        } elseif (!isValidEmail($email)) {
            $errors["invalid_email"] = 'Email is invalid';
        }

        if (isEmptyPhone($phone_number)) {
            $errors["empty_phone"] = 'Phone number is required';
        } elseif (!isValidSriLankanPhone($phone_number)) {
            $errors["invalid_phone"] = 'Phone number is invalid';
        }

        if (isEmptyPassword($password, $password_confirmation)) {
            $errors["empty_password"] = 'Password is required';
        } elseif (!isValidPassword($password, $password_confirmation)) {
            $errors["invalid_password"] = 'Passwords do not match';
        }
        
        if (isEmailInUseLoginfo($pdo, $email)) {
            $errors["used_email_loginfo"] = 'Email is already in use';
        }

        if (isEmilInUseAdmin($pdo, $email)) {
            $errors["used_email_admin"] = 'Email is already in use';
        }
        

        require_once 'config-session.php';

        // check if any errors and assign them to session variable 
        if ($errors) {

            $_SESSION["errorsRegisterAdmin"] = $errors;
            $registerDataAdmin = [
                "name" => $name,
                "email" => $email,
                "phone" => $phone_number
            ];
            $_SESSION["registerData"] = $registerData;
            header("Location: ../admin-reg.php");
            die();
        }
        
        setAdmin($pdo, $email, $password, $name, $phone_number);
        header("Location: ../admins.php");
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: ".$e->getMessage());
    }
} else {
    header('Location: ../index.php');
    exit();
}