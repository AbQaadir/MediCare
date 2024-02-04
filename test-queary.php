<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
    <style>
        .order-details {
            margin-bottom: 20px;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-table th {
            background-color: #f2f2f2;
        }
        .order-table img {
            max-width: 100px;
            max-height: 100px;
        }
        .order{
            margin-bottom: 20px;
            display: flex;
            flex-direction: column-reverse;
        }
    </style>
</head>
<body>

<?php
session_start();
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

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "medicare");

// Check if the user is logged in and get their user ID
$email = $_SESSION["email"];
$sql5 = "SELECT user_id FROM loginfo WHERE email ='$email'
        UNION
        SELECT user_id FROM superadmin WHERE email ='$email'  
        UNION
        SELECT user_id FROM admin WHERE email ='$email'";
$result = mysqli_query($con, $sql5);
$row1 = mysqli_fetch_assoc($result);
$userId = $row1['user_id'];

// Retrieve order dates associated with the user
$sql = "SELECT ord_date_time FROM pay WHERE user_id='$userId' ORDER BY ord_date_time ASC";
$result = mysqli_query($con, $sql);
$dateArray = array();
$order_id = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dateArray[] = $row['ord_date_time'];
}

// Display order details for each unique order date
$sql110= "SELECT order_id FROM statustable WHERE user_id='$userId'";
$result110 = mysqli_query($con, $sql110);


while ($row110 = mysqli_fetch_assoc($result110)) {
    $order_id[] = $row110['order_id'];
}
$unique_array = array_unique($dateArray);
$order_n = 1;

echo "<h2>Order Details</h2>";
echo "<div class='order'>";
foreach ($unique_array as $date) {
    
        $St =$order_id[$order_n-1];
    

        

    $sql119= "SELECT complete FROM statustable WHERE order_id='$St'";
    $result119 = mysqli_query($con, $sql119);
    $row119 = mysqli_fetch_assoc($result119);

    $r_time = $row119['complete'];



        $timestamp = strtotime('+3 days',  strtotime($date)); 
        $new_timestamp = date('Y-m-d H:i:s', $timestamp);
    echo "<div class='order-details'>";
    echo "<h3>Order Number: $order_n</h3>";
    echo "<p>Order Date and Time: $date</p>";
    echo "<p>Order will be delivered before: $new_timestamp</p>";
    echo "<p>Araived: $r_time</p>";

    // Retrieve products associated with the current order date
    $sql = "SELECT * FROM pay WHERE user_id='$userId' AND ord_date_time='$date'";
    $result = mysqli_query($con, $sql);
    $row_count = mysqli_num_rows($result);
    echo "<table class='order-table'>";
    echo "<thead><tr><th>Product Name</th><th>Image</th><th>Quantity</th><th>order status</th></tr></thead>";
    echo "<tbody>";
    $k=0;
    
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
        $status = "proccesing";
        if(!empty($order_id)){
            $sql101 = "SELECT status FROM statustable WHERE order_id = '$St'";
        $result101 = mysqli_query($con, $sql101);
        $row101 = mysqli_fetch_assoc($result101);
        };
        

       if(!empty($row101))
       {$status1 = $row101['status'];}else{
              $status1="proccesing";
       }
            
       

        echo "<tr>";
        echo "<td>$product_name</td>";
        
        echo "<td><img src='$filename' alt='Product Image' style='width: 100px; height: 100px;'></td>";

        echo "<td>$product_quantity</td>";
        if($k==0){
            if ($status1 == "proccesing") {
                echo "<td rowspan='$row_count'>
                <p>If the product has reached you, <br> please click the button</p>
                        <form action='status-change.php' method='post'>
                            <input type='hidden' name='order_date_time' value='$St'>
                            <button name='status_user' type='submit' style='background-color: pink;  padding: 10px; border: none; cursor: not-allowed;' disabled>$status1</button>                   
                        </form></td>";
            } elseif ($status1 == "Deliverd") {
                echo "<td rowspan='$row_count'>
                <p>If the product has reached you, <br> please click the button</p>
                        <form action='status-change.php' method='post'>
                            <input type='hidden' name='order_date_time' value='$St'>
                            <button name='status_user' type='submit' style='background-color: blue; color: white; padding: 10px; border: none; cursor: pointer; transition: background-color 0.3s;'>$status1</button>                   
                        </form></td>";
            } elseif ($status1 == "order reached") {
                echo "<td rowspan='$row_count'>
                <p>If the product has reached you, <br> please click the button</p>
                        <form action='status-change.php' method='post'>
                            <input type='hidden' name='order_date_time' value='$St'>
                            <button name='status_user' type='submit' style='background-color: green; color: white; padding: 10px; border: none; cursor: not-allowed;' disabled>$status1</button>                   
                        </form></td>";
            }else{
                echo "<td rowspan='$row_count'>
                <p>If the product has reached you, <br> please click the button</p>
                        <form action='status-change.php' method='post'>
                            <input type='hidden' name='order_date_time' value='$St'>
                            <button name='status_user' type='submit' style='background-color: pink;  padding: 10px; border: none; cursor: not-allowed;' disabled>$status1</button>                   
                        </form></td>";

            }

            
        }
        
    echo "</tr>";
        $k++;
    }
    
    
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
   
   
    $order_n++;
}

echo "</div>";
// Close database connection
mysqli_close($con);
?>

</body>
</html>
