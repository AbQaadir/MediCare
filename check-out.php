<?php
session_start();
require_once("getdata.php");
require_once("check_out_componets.php");

?>


<!DOCTYPE html>
<html>

<head>
    <title>Payment Form</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 300px;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 100px;
            border: 1px solid black;
            border-radius: 4px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container input[type="radio"] {
            margin-top: 8px;
        }

        .container input[type="tel"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .red {
            background-color: red;
        }
    </style> -->

    <style>
        .cartTab .listCart .item img {
            width: 80%;
            height: 80%;
            background-color: #eee;
        }

        .cartTab .listCart .item {
            display: grid;
            grid-template-columns: 100px 170px 300px 170px;
            gap: 10px;
            text-align: center;
            align-items: center;
            height: 100px;
            color: black;
            background-color: lightblue;
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
            width: 95%;
        }

        .listCart::-webkit-scrollbar {
            width: 0;
        }

        .cartTab {

            color: #eee;
            position: relative;


            width: 100%;
            top: 0;
            bottom: 0;
            display: grid;

        }

        .cartTab h1,
        h4 {
            text-align: center;
            padding: 20px 0;
            font-size: 30px;
            color: black;
        }

        .big {
            display: flex;
            flex-direction: column;
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

        .all {

            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="all">
            <div class="big">
                <h2><u>user Details</u></h2>
                <form action="submit_payment.php" method="post">
                    <label for="name">Name:</label><br />
                    <input type="text" id="name" name="name" required /><br />

                    <label for="email">Email:</label><br />
                    <input type="email" id="email" name="email" required /><br />

                    <label for="telephone">Telephone Number:</label><br />
                    <input type="tel" id="telephone" name="telephone" required /><br />

                    <label for="address">Home Address:</label><br />
                    <input type="text" id="address" name="address" required /><br />

                    <h3>Payment Method:</h3>


                </form>
                <div class="cartTab">
                    <div class="listCart">

                        <?php
                        $total = 0;
                        $counts = 0;
                        if (isset($_SESSION['add_cart'])) {
                            $product_id = array_column($_SESSION['add_cart'], 'product_id');

                            $result = getData();

                            while ($row = mysqli_fetch_assoc($result)) {
                                foreach ($product_id as $id) {
                                    if ($row['id_P'] == $id) {
                                        echo cartElements_checkOut($row['image'], $row['name'], $row['price'], $row['id_P'], $row['qty']);
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
                </div>
            </div>
            <div class="total">
                <h2>PRICE DETAILS</h2>
                <hr>
                <div class="c">
                    <!-- // count total -->
                    <?php
                    if (isset($_SESSION['add_cart'])) {
                        // $count = count($_SESSION['cart']);
                        echo "<h6>Price ($counts items)</h6>";
                    } else {
                        echo "<h6>Price 0 items</h6>";
                    }
                    ?>
                    <h6>
                        <?php
                        echo "<h6>LKR $total/=</h6>"
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
                        echo "<h6>LKR $total/=</h6>"
                            ?>
                    </h6>
                </div>

                <hr>
                <h4>payment method</h4>
                <form action="paymen-t.php" method="post">
                    <button class="cash" name="cash">Cash on Delivery</button>
                    <button class="online" name="online">pay now</button>
                </form>

            </div>








        </div>
    </div>
</body>

</html>