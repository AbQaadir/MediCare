<?php
session_start();
if (isset($_POST['cash'])) {
    $number = 0;
    $number = $number + 1;
    if ($number > 1) {
        $number = $number + 1;
        echo "Thank you for your order!";
        echo $number;
        exit;
    } else {
        echo "Thank you for your order!";
        echo $number;
        exit;
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 11px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        .card-type img {
            height: 30px;
            margin-right: 5px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .visa {
            width: 10%;

        }

        .master {
            width: 10%;
        }
    </style>
</head>

<body>


    <?php
    $errors = [];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate card type
        $cardType = $_POST["card_type"] ?? '';
        if (!in_array($cardType, ['visa', 'mastercard'])) {
            $errors[] = "Invalid card type";
        }

        // Validate card number
        $cardNumber = $_POST["card_number"] ?? '';
        if (!preg_match('/^\d{16}$/', $cardNumber)) {
            $errors[] = "Invalid card number. It should be a 16-digit number.";
        }

        // Validate expiry date
        $expiryDate = $_POST["expiry_date"] ?? '';
        if (!preg_match('/^\d{2}\/\d{2}$/', $expiryDate)) {
            $errors[] = "Invalid expiry date. It should be in MM/YY format.";
        }

        // Validate CVV
        $cvv = $_POST["cvv"] ?? '';
        if (!preg_match('/^\d{3}$/', $cvv)) {
            $errors[] = "Invalid CVV. It should be a 3-digit number.";
        }

        // Validate cardholder name
        $cardholderName = $_POST["cardholder_name"] ?? '';
        if (empty($cardholderName)) {
            $errors[] = "Cardholder name is required.";
        }

        // If there are no errors, you can process the payment or perform other actions
        if (empty($errors)) {
            // Process the payment or other actions here
    
            // Display thank you message
            echo "Thank you for your order!";
            exit; // Exit to prevent displaying the form again
        }
    }
    ?>

    <form method="post" action="">
        <?php
        if (isset($_POST['submit'])) {
            // Display errors, if any
            if (!empty($errors)) {
                echo '<div class="error">' . implode('<br>', $errors) . '</div>';
            }
        }
        ?>


        <label>Card Type:</label>
        <span><input class="visa" type="radio" name="card_type" value="visa" required> Visa</span>
        <span><input class="master" type="radio" name="card_type" value="mastercard" required> MasterCard</span>


        <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" id="card_number" required>

        <label for="expiry_date">Expiry Date (MM/YY):</label>
        <input type="text" name="expiry_date" id="expiry_date" pattern="\d{2}/\d{2}" placeholder="MM/YY" required>

        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" id="cvv" pattern="\d{3}" placeholder="123" required>

        <label for="cardholder_name">Cardholder Name:</label>
        <input type="text" name="cardholder_name" id="cardholder_name" required>

        <div class="card-type">
            <img src="./cardimages/visa.png" alt="Visa">
            <img src="./cardimages/master.png" alt="MasterCard">
        </div>

        <input type="submit" name="submit" value="Submit">


    </form>

</body>

</html>