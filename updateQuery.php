<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ship_name = $_POST["ship-name"];
    $ship_number = $_POST["ship-number"];
    $ship_address = $_POST["ship-address"];
    $ship_city = $_POST["ship-city"];
    $ship_zip = $_POST["ship-zip"];
    $ship_country = $_POST["ship-country"];
    require_once "./config/config-session.php";
    $ship_email = $_SESSION["email"];

    try {
        require_once "./config/db.inc.php";
        require_once "./config/models/shipping.model.php";
        require_once "./config/controllers/shipping.contr.php";

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

       

        
       

        if ($errors) {
            $_SESSION["errorsShipping"] = $errors;
            header("Location: updateShipping.php");
            exit();
        }


       
$con = mysqli_connect("localhost", "root", "", "medicare");


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Update query
$query = "UPDATE shipping_info SET
            ship_name = '$ship_name',
            ship_number = '$ship_number',
            ship_address = '$ship_address',
            ship_city = '$ship_city',
            ship_zip = '$ship_zip',
            ship_country = '$ship_country'
          WHERE ship_email = '$ship_email'";

// Execute query
if (mysqli_query($con, $query)) {
    echo "<script>alert('Shipping information updated successfully.'); window.location.href = 'check-out.php'; </script>";
    
} else {
    echo "Error updating shipping information: " . mysqli_error($con);
}

// Close connection
mysqli_close($con);

       
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    header("Location: cart-new.php");
    exit();
}
