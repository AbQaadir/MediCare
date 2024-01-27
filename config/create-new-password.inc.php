<?php
// Ensure that it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the POST request
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    try {
        // Include necessary files and classes
        require_once 'db.inc.php'; // Include your database connection
        require_once 'models/create.new.password.model.php';
        require_once 'controllers/create.new.password.contr.php';

        // Validate the form data
        $errors = array();

        // Import necessary validation functions if they're not already included
        require_once 'config-session.php';

        if (isInputEmpty($password, $confirm_password)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (!isPasswordSame($password, $confirm_password)) {
            $errors["passwords_not_match"] = "Passwords do NOT match!";
        }

        if (!isUrlValid($selector, $validator)) {
            $errors["invalid_url"] = "Invalid URL!";
        }

        $currentTime = time();
        $result = getRowData($pdo, $selector);

        if (isUrlExpired($result, $currentTime)) {
            $errors["url_expired"] = "URL expired!";
        } 
        
        if (isTokenValid($result, $validator)) {
            $errors["invalid_token"] = "Invalid token!";
        }

        if ($errors) {
            $_SESSION["errors_create_newPassword"] = $errors;

            if (isset($errors["url_expired"])) {
                header("Location: ../forgotpassword.php?url=expired");
                exit();
            } else {
                header("Location: ../create.new.password.php");
                exit();
            }
        }

        require_once 'config-session.php'; // Include session-related configuration

        $userType = checkUserType($pdo, $result["pwdResetEmail"]);

        if ($userType === "loginfo") {
            editUser($pdo, $result["pwdResetEmail"], $password);
        } elseif ($userType === "admin") {
            editAdmin($pdo, $result["pwdResetEmail"], $password);
        } else {
            header("Location: ../user-register.php");
            exit();
        }


        header("Location: ../login.php?reset=success");
        $pdo = null;
        $stmt = null;
        die();


    } catch (PDOException $e) {
        // Handle database-related errors
        die("Query failed: " . $e->getMessage());
    }
} else {
    // If not a POST request, redirect to index page
    header("Location: ../index.php");
    die();
}
?>
