<?php
session_start();
require_once('cart-component.php');
require_once('getdata.php');

/// clear all
if (isset($_POST['clear'])) {
    if (isset($_SESSION['add_cart'])) {
        $product_id = array_column($_SESSION['add_cart'], 'product_id');

        $result = getData();

        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($product_id as $id) {
                if ($row['id'] == $id) {
                    $id = $row['id'];
                    echo $id;
                    $con = mysqli_connect("localhost", "root", "", "medicare");
                    $sql1 = "UPDATE products SET qty = '1' WHERE id = '$id'";
                    $result1 = mysqli_query($con, $sql1);
                }
            }
        }
    }

    unset($_SESSION['add_cart']);
    header('Location: index.php');
    exit;

}

///minus
if (isset($_POST['update_update_btn_mins'])) {
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $qty = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    // Ensure quantity doesn't go below 1
    if ($qty > 1) {
        $sql4 = "UPDATE products SET qty = qty - 1 WHERE id = '$update_id'";
        $update_quantity_query = mysqli_query($con, $sql4);
    }

    // Redirect to shopping_cart.php
    header('Location: shopping_cart.php');
    exit;
}

/// plus
if (isset($_POST['update_update_btn'])) {
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $qty = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    $sql = "UPDATE products SET qty = qty + 1 WHERE id = '$update_id'";

    $update_quantity_query = mysqli_query($con, $sql);

    echo "<script>
  window.onload ='shopping_cart.php';
</script>";
}





///remove button
else if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $sql1 = "UPDATE products SET qty = '1' WHERE id = '$id'";
    $result1 = mysqli_query($con, $sql1);
    if ($_GET['action'] === 'removee') {

        foreach ($_SESSION['add_cart'] as $key => $value) {

            if ($value['product_id'] == $_GET['id']) {

                unset($_SESSION['add_cart'][$key]);
                if (!empty($_SESSION['add_cart'])) {
                    echo "<script>alert('product has been removed..!')</script>";
                    echo "<script>
                    window.onload ='shopping_cart.php';
                  </script>";

                }
            }
        }

    }
    if (empty($_SESSION['add_cart'])) {
        unset($_SESSION['add_cart']);
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <style>
        .cartTab .btn button {
            background-color: yellow;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-family: Poppins;
            width: 100%;
            border-radius: 10px;
        }

        .cartTab .btn .close {
            background-color: red;
            color: #eee;
        }

        .cartTab .listCart .item img {
            width: 80%;
            height: 80%;
            background-color: #eee;
        }

        .cartTab .listCart .item {
            display: grid;
            grid-template-columns: 100px 150px 150px 150px 150px;
            gap: 10px;
            text-align: center;
            align-items: center;
            height: 100px;
            color: black;
            background-color: lightblue;
        }

        .listCart .quantity span {
            display: inline-block;
            width: 30px;
            height: 30px;
            background-color: #eee;
            color: black;
            border-radius: 50%;
            padding: 2.5px 0;
        }

        .listCart .quantity span:nth-child(2) {
            background-color: transparent;
            color: #eee;
        }

        .listCart .item:nth-child(odd) {
            background-color: #fff;
        }

        .listCart {
            border-radius: 10px;
            margin: 10px 10px 10px 10px;
            padding: 10px 10px 10px 10px;
            overflow: auto;
            background-color: #fff;
            width: 65%;
        }

        .listCart::-webkit-scrollbar {
            width: 0;
        }

        .cartTab {
            background-color: #eee;
            color: #eee;
            position: fixed;
            left: 10%;

            width: 80%;
            top: 0;
            bottom: 0;
            display: grid;
            grid-template-rows: 70px 1fr 70px;

        }

        .cartTab h1,
        h4 {
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
            color: black;
        }

        .cartTab .btn {
            display: flex;
            flex-direction: space-between;
            grid-template-columns: repeat(2, 1fr);
        }

        .removee {
            background-color: red;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-family: Poppins;
            width: 100%;
            border-radius: 10px;
            padding-right: 10px;
        }

        .in {
            width: 50px;
            height: 30px;
            border-radius: 10px;
            border: none;
            text-align: center;
        }

        .listTotal {
            overflow: auto;
            display: flex;
            justify-content: space-between;
        }

        .total {
            margin-top: 10px;
            margin-right: 25px;
            color: black;
            width: 300px;
            height: 250px;
            background-color: lightblue;

            padding: 20px 20px 20px 20px;
            border-radius: 10px;
        }

        .a,
        .b,
        .c {
            display: flex;
            justify-content: space-between;
        }

        .ccc {
            background-color: #f00;
        }

        body {
            font-family: Poppins;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {

            -moz-appearance: textfield;
            appearance: textfield;
        }
    </style>
</head>

<body>
    <div class="cartTab">
        <h1>SHopping Cart</h1>
        <div class="listTotal">
            <div class="listCart">
                <?php
                $total = 0;
                $counts = 0;
                if (isset($_SESSION['add_cart'])) {
                    $product_id = array_column($_SESSION['add_cart'], 'product_id');

                    $result = getData();

                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($product_id as $id) {
                            if ($row['id'] == $id) {
                                echo cartElements($row['image'], $row['name'], $row['price'], $row['id'], $row['qty']);
                                $total = $total + (int) ($row['price'] * $row['qty']);
                                $counts = $counts + (int) $row['qty'];
                            }
                        }
                    }
                } else {
                    echo "<h4>Cart is Empty</h4>";
                }

                ?>
            </div>
            <div class="total">
                <h2>PRICE DETAILS</h2>
                <hr>
                <div class="c">
                    <!-- // count total -->
                    <?php
                    if (isset($_SESSION['add_cart'])) {

                        echo "<h6>Price ($counts items)</h6>";
                    } else {
                        echo "<h6>Price 0 items</h6>";
                    }
                    ?>
                    <h6>
                        <?php
                        echo "<h6>Rs. $total /=</h6>"
                            ?>
                    </h6>

                </div>
                <div class="b">
                    <h6>Delivery Charges</h6>
                    <h6 class="text-success">FREE</h6>
                </div>
                <hr>
                <div class="a">
                    <h6>Amount Payable</h6>

                    <h6>

                        <?php
                        echo "<h6>Rs. $total /=</h6>"
                            ?>
                    </h6>
                </div>

                <hr>

                <hr>
                <form action="check-out.php" method="post">
                    <div class="bt">
                        <button name="checkout" type="submit" class="checkout">CHECK OUT</button>
                    </div>
                </form>
            </div>
        </div>
        <form method="post">
            <div class="btn">
                <button onclick="redirectToIndex()" class="close">CLOSE</button>
                <button class="clear" name="clear" type="submit">CLEAR ALL</button>
            </div>
        </form>
    </div>
    <script src="cart.js"></script>
</body>

</html>