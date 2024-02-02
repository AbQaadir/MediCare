<?php
session_start();

require_once("getdata.php");
require_once("check_out_componets.php");



$email = $_SESSION["email"];
$con = mysqli_connect("localhost", "root", "", "medicare");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Fetch user details
$sql5 = "SELECT * FROM loginfo WHERE email ='$email'";
$result = mysqli_query($con, $sql5);
$row1 = mysqli_fetch_assoc($result);

$userId = $row1['user_id'];
$name = $row1['name'];
$tel = $row1['phone_number'];

// Insert user details into user_details table if not already present
$sql20 = "INSERT INTO user_details (name, email, telephone, address, user_id)
          VALUES ('$name', '$email', '$tel', '123 Main St, City, Country', '$userId')";
mysqli_query($con, $sql20);

// Fetch user details from user_details table
$sql5 = "SELECT * FROM user_details WHERE user_id ='$userId'";
$result = mysqli_query($con, $sql5);
$row21 = mysqli_fetch_assoc($result);

$email1 = $row21['email'];
$name1 = $row21['name'];
$tel1 = $row21['telephone'];
$address1 = $row21['address'];



// Handle form submission for updating user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get data from form
    $new_tel = "+94".$_POST['telephone'];
    $new_name = $_POST['name']; 
    $new_email = $_POST['email']; 
    $new_address = $_POST['address'];

    // Update query
    $sql22 = "UPDATE user_details
              SET name = '$new_name', email = '$new_email', telephone = '$new_tel', address = '$new_address'
              WHERE user_id = '$userId'";

    // Execute the query
    if (mysqli_query($con, $sql22)) {
        echo "<script>alert('your details updated successfully'); window.location.href = 'check-out.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>



<!DOCTYPE html>
<html>

<head>
    <title>Payment Form</title>
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

        .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        width: 400px;
        transform: translate(-50%, -50%);
        border: 1px solid #ccc;
        background-color: #fff;
        padding: 20px;
        z-index: 9999;
        
    }
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
    }

    .edit_btn{
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        width: 100px;
    }

    .popup input {
        width: 100%; /* Set input width to 100% */
    }
    .error {
        color: red;
    }
    .b .text-success{
        margin-right: 50px;
    }
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
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
    <div class="container">
        <div class="all">
            <div class="big">
                
                    <label for="name">Deliver to : <?php echo $name1; ?></label><br/>
                    <label for="email">Email to : <?php echo  $email1; ?></label><br />
                    <label for="telephone">Telephone Number :<?php echo $tel1; ?> </label><br />
                    <label for="address">Home Address:<?php echo $address1 ?></label><br />




                    <button class="edit_btn" onclick="openPopup()">change</button>

<!-- Popup container -->
<div class="popup" id="popup">
    <h2>Edit Details</h2>
    <form action="check-out.php" method="post" id="editForm">
        <label for="name">Name: </label><br>
        <input type="text" id="name" name="name" value="<?php echo $name1; ?>" required>
        <br>
        <div id="nameError" class="error"></div><br>

        <label for="email">Email: </label><br>
        <input type="email" id="email" name="email" value="<?php echo $email1; ?>" required><br>
        <div id="emailError" class="error"></div><br>


        <label for="telephone">Telephone Number: </label><br>
        <input style="width: 9%;" type="text" value="+94" readonly>
        <input style="width: 86%;" type="number" id="telephone" name="telephone"   value="<?php $firstThreeDigits = substr($tel1, 3); echo $firstThreeDigits; ?>" required><br>

        <div id="phoneError" class="error"></div><br>

        <label for="address">Home Address: </label><br>
        <input type="text" id="address" name="address" value="<?php echo $address1 ?>" required><br><br>

        

       <form action="check-out.php" method="post">
       <button name="change" type="submit">Save Changes</button>
       </form>
        
    </form>
    <button type="button" onclick="closePopup()">Cancel</button>
</div>

<!-- Overlay to darken background when popup is open -->
<div class="overlay" id="overlay"></div>




                    

               

<div class="cartTab">
<div class="listCart">

<?php


$email = $_SESSION["email"];
$con = mysqli_connect("localhost", "root", "", "medicare");
$sql5 = "SELECT user_id FROM loginfo WHERE email ='$email' ";
$result = mysqli_query($con, $sql5);
$row1=mysqli_fetch_assoc($result);
$userId = $row1['user_id'];


$con = mysqli_connect("localhost","root","","medicare");

$sql8 = "SELECT product_id FROM cart WHERE user_id ='$userId' ";

$result8 = mysqli_query($con,$sql8);

$idArray = array();

while ($row8 = mysqli_fetch_assoc($result8)) {
$idArray[] = $row8['product_id'];}

                        $total = 0;
                        $counts = 0;
                        if (!empty($idArray)) {
                            

                            $result = getData();

                            while ($row = mysqli_fetch_assoc($result)) {
                                foreach ($idArray as $id) {
                                    if ($row['id'] == $id) {

                                        $con = mysqli_connect("localhost","root","","medicare");

                                        $sql7 = "SELECT qty  FROM cart WHERE product_id = '$id' AND user_id ='$userId' ";

                                        $result7 = mysqli_query($con,$sql7);
                                        $row7 = mysqli_fetch_assoc($result7);



                                        echo cartElements_checkOut($row['fileDestination'], $row['productName'], $row['price'], $row['id'], $row7['qty']);
                                        $total = $total + (int) ($row['price'] * $row7['qty']);
                                        $counts = $counts + (int) $row7['qty'];

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
                    if (!empty($idArray)) {
                        // $count = count($_SESSION['cart']);
                        echo "<p>Price ($counts items)</p>";
                    } else {
                        echo "<p>Price 0 items</p>";
                    }
                    ?>
                    <p>
                        <?php
                        echo "<p>LKR $total/=</p>"
                            ?>
                    </p>

                </div>
                <div class="b">
                    <p>Delivery Charges</p>
                    <p class="text-success" style="color:#f00">FREE      </p>
                </div>
                <hr>
                <div class="a">
                    <p>Amount Payable</p>

                    <p>

                        <?php
                        echo "<p>LKR $total/=</p>"
                            ?>
                    </p>
                </div>

                <hr>
                <h4>payment method</h4>

                <form action="paymen-t.php" method="post">
                <button class="online" name="online">pay now online</button>
                </form>

                <form action="cash-pay.php" method="post" >
                <button class="cash" name="cash">Cash on Delivery</button>
                </form>

            </div>

        </div>
    </div>
    <script>
        // Function to open popup
        function openPopup() {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        // Function to close popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        // Function to validate email
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Function to validate phone number
        function validatePhone(phone) {
            const regex = /^\d{9}$/;
            return regex.test(phone);
        }

        // Validate form before submission
        document.getElementById('editForm').addEventListener('submit', function (event) {
            event.preventDefault();// Prevent form submission
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('telephone').value;

            // Clear previous error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('phoneError').textContent = '';

            // Validate name
            if (!name.trim()) {
                document.getElementById('nameError').textContent = 'Name is required';
                return;
            }

            // Validate email
            if (!validateEmail(email)) {
                document.getElementById('emailError').textContent = 'Invalid email address';
                return;
            }

            // Validate phone number
            if (!validatePhone(phone)) {
                document.getElementById('phoneError').textContent = 'Invalid phone number ';
                return;
            }

            // If all validations pass, submit the form
            this.submit();
            
           
        });
    </script>
</body>

</html>