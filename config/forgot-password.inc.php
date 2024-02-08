<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted username and password from the form
    $userEmail = $_POST["email"];

    try {
        require_once 'db.inc.php';
        require_once 'models/forgotpassword.model.php';
        require_once 'controllers/forgotpassword.contr.php';


        // Initialize an array to hold errors
        $errors = [];

        // Check if either username or password is empty
        if (isInputEmailEmpty($userEmail)) {
            $errors["empty_input"] = "Fill in all fields!"; 
        }

        // Check if email valid
        if (isInputEmailInvalid($userEmail)) {
            $errors["invalid_email"] = "Invalid email used!";
        }

        // Check if email is already registered
        if (!isInputEmailRegistered($pdo, $userEmail)) {
            $errors["email_notUsed"] = "Email Not Registered!";
        }
        
        // Include session configuration
        require_once 'config-session.php'; // Include session-related configuration

        // If there are errors, store them in a session and redirect to login page
        if ($errors) {
            $_SESSION["errors_forgot_password"] = $errors;

            header("Location: ../forgot-password.php");
            die();
        }

        // Initialize $pdo, $verified, and $token
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url = "http://localhost/medicare/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
        $expires = time() + 1800; 

        deleteUser($pdo, $userEmail); // Delete any existing user with the same email
        // If no errors, create user in the database
        createPwdReset($pdo, $userEmail, $selector, $token, $expires);

        $to = $userEmail;
        $subject = "Assignment 02";
        $message = $url;

        require_once '../vendor/autoload.php'; // Include autoload for email sending library
        sendEmail($to, $subject, $message); // Send password reset email

        header("Location: ../forgot-password.php?reset=success");
        $pdo = null; // Close the database connection
        $stmt = null; // Clear the statement
        die(); // Terminate script execution

    } catch (PDOException $e) {
        // Handle any database-related errors
        die("Query failed: " . $e->getMessage());
    }
} else {
    // If the request method is not POST, redirect to the index page
    header("Location: login.php");
    exit();
}
?>