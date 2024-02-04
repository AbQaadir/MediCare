<?php
session_start();
require_once('wishlistCart-component.php');
require_once('getdata.php');



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

$sql8 = "SELECT product_id FROM wishlist WHERE user_id ='$userId' ";

$result8 = mysqli_query($con, $sql8);

$result = getData();

$idArray = array();

while ($row8 = mysqli_fetch_assoc($result8)) {
    $idArray[] = $row8['product_id'];
}

/// clear all
if (isset($_POST['clear'])) {
    // if (!empty($idArray)) {


    //     $result = getData();

    //     while ($row = mysqli_fetch_assoc($result)) {
    //         foreach ($idArray as $id) {
    //             if ($row['id'] == $id) {
    //                 $id = $row['id'];
    //                 echo $id;
    //                 $con = mysqli_connect("localhost", "root", "", "medicare");
    //                 $sql1 = "UPDATE cart SET qty = '1' WHERE product_id = '$id'  AND user_id ='$userId'";
    //                 $result1 = mysqli_query($con, $sql1);
    //             }
    //         }
    //     }
    // }

    // $sql10 = "DELETE FROM cart WHERE user_id ='$userId' ";
    // $result10 = mysqli_query($con, $sql10);

    unset($_SESSION['add_cart']);
    header('Location: index.php');
    exit;
}///remove button
else if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $con = mysqli_connect("localhost", "root", "", "medicare");
    $sql1 = "UPDATE cart SET qty = '1' WHERE product_id = '$id' AND user_id ='$userId'";
    $result1 = mysqli_query($con, $sql1);
    $sql11 = "DELETE FROM cart WHERE product_id = '$id' AND user_id ='$userId' ";
    $result11 = mysqli_query($con, $sql11);
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

        .b .text-success {
            margin-right: 60px;
        }

        .checkout {
            margin-top: 20px;
            background-color: #f00;
            color: #eee;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-family: Poppins;
            width: 100%;
            border-radius: 10px;
            padding-right: 10px;
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
        <h1> </h1>
        <div class="listTotal">
            <div class="listCart">
                <h1>whishlist</h1>

                <?php
                $total = 0;
                $counts = 0;
                $con = mysqli_connect("localhost", "root", "", "medicare");

                $sql8 = "SELECT product_id FROM wishlist WHERE user_id ='$userId' ";

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

                                 echo wishCartElements($row['fileDestination'], $row['productName'], $row['price'], $row['id']);
                                
                            }
                        }
                    }
                } else {
                    $total = 0;
                    $counts = 0;
                    $con = mysqli_connect("localhost", "root", "", "medicare");

                    $sql8 = "SELECT product_id FROM wishlist WHERE user_id ='$userId' ";

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

                                
                                    echo wishCartElements($row['fileDestination'], $row['productName'], $row['price'], $row['id']);
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

                        echo "<h4>There are no items in this whishlist</h4>";
                        echo "<form action='index.php' method='post'>";                      
                        echo "<button  class='cart-to-index-page-button' >COUNTINUE SHOPPING</button>";
                        echo "</form>";
                        
                    }
                }

                ?>
            </div>
      
           
        </div>
        <form method="post">
            <div class="btn">
                <button onclick="redirectToIndex()" class="close">CLOSE</button>
                
            </div>
        </form>
    </div>
    <script src="cart.js"></script>
    
    
  
</body>

</html>