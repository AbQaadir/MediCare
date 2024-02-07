<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ship_name = $_POST["ship-name"];
    $ship_number = $_POST["ship-number"];
    $ship_address = $_POST["ship-address"];
    $ship_city = $_POST["ship-city"];
    $ship_zip = $_POST["ship-zip"];
    $ship_country = $_POST["ship-country"];
    $ship_email = $_SESSION["email"];

    try {
        require_once "db.inc.php";
        require_once "models/shipping.model.php";
        require_once "controllers/shipping.contr.php";

        $errors = array();

        if (isShipNameEmpty($ship_name)) {
            $errors["empty_name"] = "Name is required";
        }

        if (isShipPhoneEmpty($ship_number)) {
            $errors["empty_phone"] = "Phone is required";
        }

        if (isShipAddressEmpty($ship_address)) {
            $errors["empty_address"] = "Address is required";
        }

        if (isShipCityEmpty($ship_city)) {
            $errors["empty_city"] = "City is required";
        }

        if (isShipZipEmpty($ship_zip)) {
            $errors["empty_zip"] = "ZIP is required";
        }

        if (isShipCountryEmpty($ship_country)) {
            $errors["empty_country"] = "Country is required";
        }

        // if(isEmailAlreadyExist($pdo,$email)){
        //     $errors["used_email"] = "Email is already in use";
        // }

        
        require_once "config-session.php";

        if ($errors) {
            $_SESSION["errorsShipping"] = $errors;
            header("Location: ../shipping.php");
            exit();
        }

        addShippingInfo($pdo, $ship_name, $ship_email, $ship_number, $ship_address, $ship_city, $ship_zip, $ship_country);
        header("Location: ../payment-cash.php");
        $pdo = null;
        $state = null;
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    header("Location: ../index.php");
    exit();
}
