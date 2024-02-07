<?php

require_once 'header.php';
require_once('cart-component.php');
// require_once('getdata.php');



if (isset($_SESSION["email"])) {

$email = $_SESSION["email"];
$con = mysqli_connect("localhost", "root", "", "medicare");
$sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
UNION
SELECT user_id FROM superadmin WHERE email ='$email'  
UNION
SELECT user_id FROM admin WHERE email ='$email'

";
$result = mysqli_query($con, $sql5);
$row1 = mysqli_fetch_assoc($result);
$userId = $row1['user_id'];

$con = mysqli_connect("localhost", "root", "", "medicare");

$sql8 = "SELECT product_id FROM cart WHERE user_id ='$userId' ";

$result8 = mysqli_query($con, $sql8);

$result = getData();

$idArray = array();

while ($row8 = mysqli_fetch_assoc($result8)) {
    $idArray[] = $row8['product_id'];
}

/// clear all
if (isset($_POST['clear'])) {
    if (!empty($idArray)) {


        $result = getData();

        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($idArray as $id) {
                if ($row['id'] == $id) {
                    $id = $row['id'];
                    echo $id;
                    $con = mysqli_connect("localhost", "root", "", "medicare");
                    $sql1 = "UPDATE cart SET qty = '1' WHERE product_id = '$id'  AND user_id ='$userId'";
                    $result1 = mysqli_query($con, $sql1);
                }
            }
        }
    }

    $sql10 = "DELETE FROM cart WHERE user_id ='$userId' ";
    $result10 = mysqli_query($con, $sql10);

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
        $sql4 = "UPDATE cart SET qty = qty - 1 WHERE product_id = '$update_id' AND user_id ='$userId'";
        $update_quantity_query = mysqli_query($con, $sql4);
    } else {
        $sql11 = "DELETE FROM cart WHERE product_id = '$update_id' AND user_id ='$userId' ";
        $result11 = mysqli_query($con, $sql11);
    }

    // Redirect to shopping_cart.php
    header('Location: cart-new.php');
    exit;
}

/// plus
if (isset($_POST['update_update_btn'])) {
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $qty = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];


    $sql32 = "SELECT qty_p FROM products WHERE id ='$update_id'";
    $result32 = mysqli_query($con, $sql32);
    $row32 = mysqli_fetch_assoc($result32);

    $in = $row32['qty_p'];



    if ($row32['qty_p'] > $qty) {
        $sql = "UPDATE cart SET qty = qty + 1 WHERE product_id = '$update_id' AND user_id ='$userId' ";

        $update_quantity_query = mysqli_query($con, $sql);

        header('Location: cart-new.php');
        exit;


    } else if ($in == 0) {

        $sql41 = "DELETE FROM cart WHERE product_id = '$update_id' AND user_id ='$userId' ";
        $result41 = mysqli_query($con, $sql41);


        echo "<script>alert('out of stock'); window.location.href = 'cart-new.php';</script>";
    } else if ($in == $qty) {

        echo "<script>alert('only $in products  in stock'); window.location.href = 'cart-new.php';</script>";
    } else if($row32['qty_p'] < $qty) {
        $sql = "UPDATE cart SET qty = '$in' WHERE product_id = '$update_id' AND user_id ='$userId' ";
        $update_quantity_query = mysqli_query($con, $sql);

        echo "<script>alert('you can by $in products for now '); window.location.href = 'cart-new.php';</script>";
    }

   
}





///remove button
else if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $sql1 = "UPDATE cart SET qty = '1' WHERE product_id = '$id' AND user_id ='$userId'";
    $result1 = mysqli_query($con, $sql1);
    $sql11 = "DELETE FROM cart WHERE product_id = '$id' AND user_id ='$userId' ";
    $result11 = mysqli_query($con, $sql11);

    header('Location: cart-new.php');
    exit;
}

}else{
    $_SESSION['direct-to-cart']="yes";
    header('Location: login.php');
    exit;}

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
    background-color: #0866ff;
    border: none;
    cursor: pointer;
    font-weight: 500;
    font-family: Poppins;
    width: 100%;
    border-radius: 10px;
    padding: 10px 10px 10px 10px;
    margin-top: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.cartTab .btn button:hover {
    background-color: #0056b3; /* Darker shade of blue on hover */
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2), 0px 2px 4px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
    transform: translateY(-1px); /* Lift the button slightly on hover */
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
            grid-template-columns: 100px 150px 150px 180px 150px;
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
            background-color: lightblue;
        }

        .listCart {
            border-radius: 10px;
            margin: 10px 10px 10px 10px;
            padding: 10px 10px 10px 10px;
            overflow: auto;
            background-color: #fff;
            width: 65%;
            height: 455px;
            
        }

        .listCart::-webkit-scrollbar {
            width: 0;
        }
       

        .cartTab {
            background-color: #eee;
            color: #eee;           
            margin-left: 10%;
            width: 80%;
            /* top: 100px; */
            height: 640px;
            bottom: 0;
            display: grid;
            grid-template-rows: 70px 1fr 70px;
            -moz-appearance: textfield;
            appearance: textfield;
            overflow: auto;

        }

        .cartTab h1,
        h4 {
            text-align: center;
            font-size: 30px;
            color: black;
        }

        .cartTab .btn {
            display: flex;
            flex-direction: space-between;
            grid-template-columns: repeat(2, 1fr);
        }

        .removee {
    background-color: #ff4d4d; /* Red background color */
    border: none;
    cursor: pointer;
    font-weight: 500;
    font-family: Poppins;
    width: 100%;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.08); /* Adding box shadow for 3D effect */
    transition: all 0.3s ease; /* Adding transition for smooth hover effect */
}

.removee:hover {
    background-color: #e60000; /* Darker shade of red on hover */
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2), 0px 2px 4px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
    transform: translateY(-1px); /* Lift the button slightly on hover */
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
            background-color: lightblue;
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

        .b .text-success {
            margin-right: 60px;
        }

        .checkout {
            background-color: #4CAF50;
    border: none;
    cursor: pointer;
    font-weight: 500;
    font-family: Poppins;
    width: 100%;
    border-radius: 10px;
    padding: 10px 10px 10px 10px;
    margin-top: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
        }

        .checkout:hover {
            background-color: #45a049; /* Darker shade of green on hover */
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2), 0px 2px 4px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
    transform: translateY(-1px); /* Change background color on hover */
}
    
        .cart-to-index-page-button {
    display: block;
    margin: 0 auto; /* Center the button horizontally */
    padding: 10px 20px;
    background-color: #0866ff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}



.cart-to-index-page-button:hover {
    background-color: #0454c2; /* Change background color on hover */
}

.updateBtn {
    border: none;
    border-radius: 50%; /* Make it round */
    width: 40px; /* Set width and height for a round button */
    height: 40px;
    background-color: #0866ff; /* Change to your desired color */
    color: white;
    font-size: 20px; /* Adjust font size as needed */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.updateBtn:hover {
    background-color: #0454c2; /* Change background color on hover */
}

.updateBtnn {
    border: none;
    border-radius: 50%; /* Make it round */
    width: 40px; /* Set width and height for a round button */
    height: 40px;
    background-color: #0866ff; /* Change to your desired color */
    color: white;
    font-size: 20px; /* Adjust font size as needed */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.updateBtnn:hover {
    background-color: #0454c2; /* Change background color on hover */
}

    </style>
</head>

<body>
    <div class="cartTab">
        <h1>Shopping Cart </h1>
        <div class="listTotal">
            <div class="listCart">
                

                <?php
                $total = 0;
                $counts = 0;
                $con = mysqli_connect("localhost", "root", "", "medicare");

                $sql8 = "SELECT product_id FROM cart WHERE user_id ='$userId' ";

                $result8 = mysqli_query($con, $sql8);

                $result = getData();

                $idArray = array();

                while ($row8 = mysqli_fetch_assoc($result8)) {
                    $idArray[] = $row8['product_id'];
                }



                if (!empty($idArray)) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        foreach ($idArray as $id) {

                            if (($row['id'] == $id)) {


                                $con = mysqli_connect("localhost", "root", "", "medicare");

                                $sql7 = "SELECT qty  FROM cart WHERE product_id = '$id' AND user_id ='$userId' ";

                                $result7 = mysqli_query($con, $sql7);
                                $row7 = mysqli_fetch_assoc($result7);



                                echo cartElements($row['fileDestination'], $row['productName'], $row['price'], $row['id'], $row7['qty']);
                                $total = $total + (int) ($row['price'] * $row7['qty']);
                                $counts = $counts + (int) $row7['qty'];
                            }
                        }
                    }
                } else {
                    $total = 0;
                    $counts = 0;
                    $con = mysqli_connect("localhost", "root", "", "medicare");

                    $sql8 = "SELECT product_id FROM cart WHERE user_id ='$userId' ";

                    $result8 = mysqli_query($con, $sql8);

                    $result = getData();

                    $idArray = array();

                    while ($row8 = mysqli_fetch_assoc($result8)) {
                        $idArray[] = $row8['product_id'];
                    }



                    if (!empty($idArray)) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            foreach ($idArray as $id) {

                                if (($row['id'] == $id)) {


                                    $con = mysqli_connect("localhost", "root", "", "medicare");

                                    $sql7 = "SELECT qty  FROM cart WHERE product_id = '$id' AND user_id ='$userId' ";

                                    $result7 = mysqli_query($con, $sql7);
                                    $row7 = mysqli_fetch_assoc($result7);



                                    echo cartElements($row['fileDestination'], $row['productName'], $row['price'], $row['id'], $row7['qty']);
                                    $total = $total + (int) ($row['price'] * $row7['qty']);
                                    $counts = $counts + (int) $row7['qty'];



                                    if($row7['qty'] == 1){
                                        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var buttonn = document.getElementById('minusbtn');
                buttonn.disabled = true;
                buttonn.style.backgroundColor = 'pink';
            });
        </script>";
                                    }
                                    


                                }
                            }
                        }
                    } else {

                        echo "<h4>There are no items in this cart</h4>";
                        echo "<form action='index.php' method='post'>";                      
                        echo "<button  class='cart-to-index-page-button' >COUNTINUE SHOPPING</button>";
                        echo "</form>";
                        $total = 0;
                        $counts = 0;
                    }
                }

                ?>
            </div>
            <div class="total">
                <h2>PRICE DETAILS</h2>
                <hr>
                <div class="c">
                    <!-- // count total -->
                    <?php
                    if (isset($_SESSION['add_cart']) || !empty($idArray)) {

                        echo "<p>Price ($counts items)</p>";
                    } else {
                        echo "<p>Price 0 items</p>";
                    }
                    ?>
                    <p>
                        <?php
                        echo "<p>Rs. $total /=</p>"
                        ?>
                    </p>

                </div>
                <div class="b">
                    <p>Delivery Charges</p>
                    <p class="text-success" style="color:#f00">FREE</p>
                </div>
                <hr>
                <div class="a">
                    <p>Amount Payable</p>

                    <p>

                        <?php
                        echo "<p>Rs. $total /=</p>"
                        ?>
                    </p>
                </div>

                <hr>

                <hr>

                <form action="payment-cash.php" method="post">
                    <div class="bt">
                        <button id="checkout" name="checkout" type="submit" class="checkout"> PROCEED TO CHECKOUT (<?php echo $counts ?>)</button>
                    </div>
                </form>
                <br><hr><hr><hr>

                <?php if (isset($_SESSION["userType"])){
                        if ($_SESSION["userType"] === "admin"){echo '
                            
                            ';}
                        else if($_SESSION["userType"] === "superadmin"){echo '
                            
                            ';}
                        else {
                           
                            echo '
                            <form action="test-queary.php" method="post">
                                <div class="btn">
                                    <button type="submit">my orders</button>                   
                                </div>
                            </form>
                            ';
                           
                        }
                        
                    }
                    ?>

           

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
    <?php
    if ($counts == 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var button = document.getElementById('checkout');
                button.disabled = true;
                button.style.backgroundColor = 'pink';
            });
        </script>";
    }

    
    ?>
    <?php
require_once 'footer.php';
?>
</body>

</html>