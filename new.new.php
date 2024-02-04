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

// Close database connection
mysqli_close($con);
?>

</body>
</html>