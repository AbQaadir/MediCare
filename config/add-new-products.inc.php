<?php

if (isset($_POST["submit"])) {
    $file = $_FILES["productImage"];
    $productName = $_POST["productName"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    try {
        require_once 'db.inc.php';
        require_once 'models/upload.model.php';
        require_once 'controllers/upload.contr.php';

        // Initialize an array to hold errors
        $errors = [];

        // Check if either username or password is empty
        if (isUploadEmpty($file)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        // Check if email valid
        if (isUploadInvalid($file)) {
            $errors["invalid_upload"] = "Invalid upload!";
        }

        // Check if email is already registered
        if (isUploadError($file)) {
            $errors["upload_error"] = "Upload error!";
        }

        // Check if email is already registered
        if (isUploadSizeInvalid($file)) {
            $errors["upload_size"] = "Upload size too large!";
        }

        // Check if email is already registered
        if (isUploadTypeInvalid($file)) {
            $errors["upload_type"] = "Upload type not allowed!";
        }

        // Check if email is already registered
        if (isUploadNameInvalid($file)) {
            $errors["upload_name"] = "Upload name invalid!";
        }
        if (isPriceEmpty($price)) {
            $errors["empty_price"] = 'Price is required';
        }

        if (isProductNameEmpty($productName)) {
            $errors["empty_productName"] = 'Product Name is required';
        }

        if (isDescriptionEmpty($description)) {
            $errors["empty_description"] = 'Description is required';
        }

        // Include session configuration
        require_once 'config-session.php'; // Include session-related configuration

        // If there are errors, store them in a session and redirect to login page
        if ($errors) {
            $_SESSION["errors_upload"] = $errors;

            header("Location: ../upload.php");
            die();
        }

        // Initialize $pdo, $verified, and $token
        $fileNameNew = $file["name"];
        $fileDestination = "../uploads/" . $fileNameNew;

        // If no errors, create user in the database
        createUpload($pdo, $fileNameNew, $fileDestination, $productName, $description, $price, $category);

        header("Location: ../index.php?upload=success");
        $pdo = null; // Close the database connection
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }
} else {
    header("Location: ../upload.php");
    exit();
}
