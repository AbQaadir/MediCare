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
    session_start();
    $errors = [];

    $email = $_SESSION["email"];
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
    UNION
    SELECT user_id FROM superadmin WHERE email ='$email'  
    UNION
    SELECT user_id FROM admin WHERE email ='$email'";
    $result = mysqli_query($con, $sql5);
    $row1 = mysqli_fetch_assoc($result);
    $userId = $row1['user_id'];

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


            $sql13 = "SELECT product_id, qty FROM cart WHERE user_id='$userId'";
            $result13 = mysqli_query($con, $sql13);
            $num = mysqli_num_rows($result13);
            $idOut = array();
            $idOut2 = array();

            while ($row13 = mysqli_fetch_assoc($result13)) {
                $product_id = $row13['product_id'];
                $qty = $row13['qty'];

                $sql35 = "SELECT qty_p FROM products WHERE id ='$product_id'";
                $result35 = mysqli_query($con, $sql35);
                $row35 = mysqli_fetch_assoc($result35);

                $sql37 = "SELECT productName FROM products WHERE id ='$product_id'";
                $result37 = mysqli_query($con, $sql37);
                $row37 = mysqli_fetch_assoc($result37);
                $productName = $row37['productName'];
                $qty_p = $row35['qty_p'];

                if ($row35['qty_p'] == 0) {
                    $sql36 = "DELETE FROM cart WHERE user_id='$userId' AND product_id='$product_id'";
                    $result36 = mysqli_query($con, $sql36);
                    $idOut[] = $row37['productName'];
                } else if ($row35['qty_p'] < $qty) {
                    $sql50 = "UPDATE cart SET qty = '$qty_p' WHERE user_id='$userId' AND product_id='$product_id'";
                    $result50 = mysqli_query($con, $sql50);
                    $idOut2[] = $row37['productName'];
                }
            }


            $count = count($idOut);
            $count2 = count($idOut2);



            if (!empty($idOut) && empty($idOut2)) {

                if ($count == $num) {

                    if ($count == 1) {
                        echo "<script>alert('The following product is out of stock: " . implode(", ", $idOut) . "'); window.location.href = 'index.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('The following products are out of stock: " . implode(", ", $idOut) . "'); window.location.href = 'index.php';</script>";
                        exit;
                    }
                } else {
                    if ($count == 1) {
                        echo "<script>alert('The following product is out of stock: " . implode(", ", $idOut) . "'); window.location.href = 'check-out.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('The following products are out of stock: " . implode(", ", $idOut) . "'); window.location.href = 'check-out.php';</script>";
                        exit;
                    }
                }
            }

            if (!empty($idOut) && !empty($idOut2)) {


                if ($count == 1) {
                    echo "<script>alert('The following product is out of stock: " . implode(", ", $idOut) . "'); </script>";
                } else {
                    echo "<script>alert('The following products are out of stock: " . implode(", ", $idOut) . "');</script>";
                }
            }





            if ($count2 == 1) {
                echo "<script>alert('The following product cannot satisfy the requested amount, and we will update you on how much of this product you can buy: " . implode(", ", $idOut2) . "'); window.location.href = 'check-out.php';</script>";
                exit;
            }

            if ($count2 > 1) {

                echo "<script>alert('The following products cannot satisfy the requested amount, and we will update you on how much of these products you can buy: " . implode(", ", $idOut2) . "'); window.location.href = 'check-out.php';</script>";
                exit;
            }


            // Fetching user ID from session
            $email = $_SESSION["email"];
            $con = mysqli_connect("localhost", "root", "", "medicare");
            $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
            UNION
            SELECT user_id FROM superadmin WHERE email ='$email'  
            UNION
            SELECT user_id FROM admin WHERE email ='$email'";
            $result = mysqli_query($con, $sql5);
            $row1 = mysqli_fetch_assoc($result);
            $userId = $row1['user_id'];


            // Loop through each product in the cart and insert into the 'pay' table
            $sql13 = "SELECT product_id, qty FROM cart WHERE user_id='$userId'";
            $result13 = mysqli_query($con, $sql13);

            while ($row13 = mysqli_fetch_assoc($result13)) {
                $product_id = $row13['product_id'];
                $qty = $row13['qty'];


                $sql36 = "UPDATE products SET qty_p = qty_p - '$qty' WHERE id = '$product_id'";
                $result36 = mysqli_query($con, $sql36);

                // Insert the product into the 'pay' table
                $sql14 = "INSERT INTO pay (user_id, product_id, qty) VALUES ('$userId', '$product_id', '$qty')";
                $result14 = mysqli_query($con, $sql14);



                if (!$result14) {
                    // Handle insertion error
                    echo "Error inserting product ID: $product_id into pay table.<br>";
                }
            }

            // Delete all products from the cart
            $sql15 = "DELETE FROM cart WHERE user_id='$userId'";
            $result15 = mysqli_query($con, $sql15);
            if (!$result15) {
                // Handle deletion error
                echo "Error deleting products from cart.<br>";
            }

            echo "<script>alert('Products have been successfully ordered'); window.location.href = 'index.php';</script>";
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
            <img src="./uploads/pngwing.com.png" alt="Visa">

        </div>

        <input type="submit" name="submit" value="Submit">


    </form>

</body>

</html>