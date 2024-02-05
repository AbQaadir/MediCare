<?php
session_start();

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

if (isset($_POST['cash'])) {



    // Loop through each product in the cart and insert into the 'pay' table
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




    // Loop through each product in the cart and insert into the 'pay' table
    $sql13 = "SELECT product_id, qty FROM cart WHERE user_id='$userId'";
    $result13 = mysqli_query($con, $sql13);
    $num = mysqli_num_rows($result13);
    $idOut = array();

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

    $con = mysqli_connect("localhost", "root", "", "medicare");

$email = $_SESSION["email"];
$sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
        UNION
        SELECT user_id FROM superadmin WHERE email ='$email'  
        UNION
        SELECT user_id FROM admin WHERE email ='$email'";

$result = mysqli_query($con, $sql5);
$row1 = mysqli_fetch_assoc($result);

$sql = "SELECT ord_date_time, user_id FROM pay ORDER BY ord_date_time ASC";
$result = mysqli_query($con, $sql);
$dateArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dateArray[] = $row['ord_date_time'];}
$order_number = 1;
$unique_array = array_unique($dateArray);

foreach ($unique_array as $date) {

    $sql = "SELECT * FROM pay WHERE  ord_date_time='$date'";
    $result = mysqli_query($con, $sql);
    $row_count = mysqli_num_rows($result);
   
    $i=0;
    $j=0;
    while ($row = mysqli_fetch_assoc($result)) {

       $ord_date_time_new = $row['ord_date_time'];
        $product_id = $row['product_id'];
        $sql1 = "SELECT * FROM products WHERE id='$product_id'";
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $product_name = $row1['productName'];
        $product_price = $row1['price'];
        $product_image = $row1['fileDestination'];
        $filename = "uploads/" . basename($product_image);
        $product_quantity = $row['qty'];
        $user_id = $row['user_id'];
        $status = "proccesing";
        $sql100 ="INSERT INTO statusTable (order_id, user_id, product_id, status) VALUES ('$order_number', '$user_id', '$product_id', ' $status')";
        $result100 = mysqli_query($con, $sql100);
        $sql101 = "SELECT status FROM statusTable WHERE order_id = '$order_number'";
        $result101 = mysqli_query($con, $sql101);
        $row101 = mysqli_fetch_assoc($result101);
        $status1 = $row101['status'];

 $i++;
    }
    $order_number++; 
}


    // Delete all products from the cart
    $sql15 = "DELETE FROM cart WHERE user_id='$userId'";
    $result15 = mysqli_query($con, $sql15);
    if (!$result15) {
        // Handle deletion error
        echo "Error deleting products from cart.<br>";
    }

    echo "<script>alert('Products have been successfully ordered'); window.location.href = 'index.php';</script>";
    exit;
}
