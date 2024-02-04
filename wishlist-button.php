<?php
session_start();


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

$idArray = array();

while ($row8 = mysqli_fetch_assoc($result8)) {
  $idArray[] = $row8['product_id'];
}




if (isset($_POST['add'])) {


  $id = $_POST['product_id'];
  $sql30 = "SELECT qty_p FROM products WHERE id ='$id'";
  $result30 = mysqli_query($con, $sql30);
  $row30 = mysqli_fetch_assoc($result30);





    if (isset($_SESSION['add_cart'])) {


      if ((in_array($_POST['product_id'], $idArray))) {

        echo "<script>alert('product is already added in the cart..!'); window.location.href = 'index.php'; </script>";
      } else {



        $_SESSION['add_cart'][$count] = $item_array;
        $email = $_SESSION["email"];
        $product_id = $_POST['product_id'];
        $con = mysqli_connect("localhost", "root", "", "medicare");
        $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
        UNION
        SELECT user_id FROM superadmin WHERE email ='$email'  
        UNION
        SELECT user_id FROM admin WHERE email ='$email'";
        $result = mysqli_query($con, $sql5);
        $row1 = mysqli_fetch_assoc($result);
        $userId = $row1['user_id'];
        $sql6 = "INSERT INTO wishlist (user_id, product_id) VALUES ('$userId', '$product_id' )";
        $update_quantity_query1 = mysqli_query($con, $sql6);

        header('location:index.php');
      }
    } else {

      if ((in_array($_POST['product_id'], $idArray))) {


        echo "<script>alert('product is already added in the wishlist..!'); window.location.href = 'index.php';</script>";
      } else {



        $email = $_SESSION["email"];
        $product_id = $_POST['product_id'];
        $con = mysqli_connect("localhost", "root", "", "medicare");
        $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
        UNION
        SELECT user_id FROM superadmin WHERE email ='$email'  
        UNION
        SELECT user_id FROM admin WHERE email ='$email'";
        $result = mysqli_query($con, $sql5);
        $row1 = mysqli_fetch_assoc($result);
        $userId = $row1['user_id'];
        $sql6 = "INSERT INTO wishlist (user_id, product_id) VALUES ('$userId', '$product_id' )";
        $update_quantity_query1 = mysqli_query($con, $sql6);

        header('location:index.php');
      }
    }
  }

