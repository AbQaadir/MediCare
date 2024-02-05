<?php

require_once '../login.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        require_once 'db.inc.php';
        require_once 'models/login.model.php';
        require_once 'controllers/login.contr.php';

        $errors = array();

        if (isEmptyEmail($email)) {
            $errors["empty_email"] = 'Email is required';
        } else if (!isValidEmail($email)) {
            $errors["invalid_email"] = 'Email is invalid';
        }

        if (isEmptyPassword($password)) {
            $errors["empty_password"] = 'Password is required';
        }

        $userType = getUserType($pdo, $email);

        if (isEmailWrong($userType)) {
            $errors["wrong_email"] = 'Incorrect Login Info!';
        } else {
            if ($userType["table_name"] === 'loginfo') {
                $result = getLoginfo($pdo, $email);
            } else if ($userType["table_name"] === 'admin') {
                $result = getAdmin($pdo, $email);
            } else if ($userType["table_name"] === 'superadmin') {
                $result = getSuperAdmin($pdo, $email);
            }
    
            if (isEmailWrong($result)) {
                $errors["wrong_email"] = 'Incorrect Login Info!';
            }
    
            if (!isEmailWrong($result) && isPasswordWrong($password, $result["password"])) {
                $errors["wrong_password"] = 'Incorrect Login Info!';
            }
        }

        require_once 'config-session.php';

        if ($errors) {
            $_SESSION['errorsLogin'] = $errors;
            header('Location: ../login.php');
            exit();
        }

        $_SESSION["userType"] = $userType["table_name"];
        $_SESSION["email"] = $result["email"];

        if(isset($_SESSION["w_id"])){ 
          require_once '../wishlist-button.php';
         }



       


if(isset($_SESSION["p_id"])){ 
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

$idArray = array();

while ($row8 = mysqli_fetch_assoc($result8)) {
  $idArray[] = $row8['product_id'];
}


  $id_P = $_SESSION["p_id"];
  $sql30 = "SELECT qty_p FROM products WHERE id ='$id_P'";
  $result30 = mysqli_query($con, $sql30);
  $row30 = mysqli_fetch_assoc($result30);

  if ($row30['qty_p'] == 0) {
    echo "<script>alert('Product is out of stock..!'); window.location.href = '../index.php';</script>";
    echo "<script>document.querySelector('script:last-of-type').style.backgroundColor = 'red';</script>";
  } else {



    if (isset($_SESSION['add_cart'])) {


      if ((in_array($_POST['product_id'], $idArray))) {

        echo "<script>alert('product is already added in the cart..!'); window.location.href = '../index.php'; </script>";
      } else {



        $_SESSION['add_cart'][$count] = $item_array;
        $email = $_SESSION["email"];
        $product_id = $_SESSION["p_id"];
        $con = mysqli_connect("localhost", "root", "", "medicare");
        $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
        UNION
        SELECT user_id FROM superadmin WHERE email ='$email'  
        UNION
        SELECT user_id FROM admin WHERE email ='$email'";
        $result = mysqli_query($con, $sql5);
        $row1 = mysqli_fetch_assoc($result);
        $userId = $row1['user_id'];
        $sql6 = "INSERT INTO cart (user_id, product_id) VALUES ('$userId', '$product_id' )";
        $update_quantity_query1 = mysqli_query($con, $sql6);

        header('location:../cart-new.php');
      }
    } else {

      if ((in_array($_SESSION["p_id"], $idArray))) {


        echo "<script>alert('product is already added in the cart..!'); window.location.href = '../index.php';</script>";
        
      } else {



        $email = $_SESSION["email"];
        $product_id = $_SESSION["p_id"];
        $con = mysqli_connect("localhost", "root", "", "medicare");
        $sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
        UNION
        SELECT user_id FROM superadmin WHERE email ='$email'  
        UNION
        SELECT user_id FROM admin WHERE email ='$email'";
        $result = mysqli_query($con, $sql5);
        $row1 = mysqli_fetch_assoc($result);
        $userId = $row1['user_id'];
        $sql6 = "INSERT INTO cart (user_id, product_id) VALUES ('$userId', '$product_id' )";
        $update_quantity_query1 = mysqli_query($con, $sql6);

        header('location:../cart-new.php');
      }
    }
  }}else{

    if(isset($_SESSION['direct-to-cart'])){

        echo "<script>window.location.href = '../cart-new.php';</script>";
        $pdo = null;
        $state = null;
        exit();
        

    }else if(isset($_SESSION['direct-to-wish'])){
      echo "<script>window.location.href = '../wishlist.php';</script>";
      $pdo = null;
      $state = null;
      exit();
    }

    header('location: ../index.php');
        $pdo = null;
        $state = null;
        exit();

  }




        

    } catch (PDOException $e) {
        die('Query failed: ' . $e->getMessage());
    }
} else {
    header('Location: login.php');
    exit();
}