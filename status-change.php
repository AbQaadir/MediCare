<?php 

if(isset($_POST['status'])){
    $dateTime = $_POST['order_date_time'];

    $con = mysqli_connect("localhost", "root", "", "medicare");

    $sql = "UPDATE statustable SET status = 'Deliverd' WHERE order_id = '$dateTime'";
    $result = mysqli_query($con, $sql);

    echo "<script>alert('Order status updated successfully!'); window.location.href = 'test-q-for-admin.php';</script>";
    exit;

}

if(isset($_POST['status_user'])){
    $dateTime = $_POST['order_date_time'];

    $con = mysqli_connect("localhost", "root", "", "medicare");

    $sql = "UPDATE statustable SET status = 'order reached' WHERE order_id = '$dateTime'";
    $result = mysqli_query($con, $sql);

    $currentTimestamp = date('Y-m-d H:i:s');

// Update the statusTable with the received timestamp
$sql = "UPDATE statustable SET complete='$currentTimestamp' WHERE order_id='$dateTime'";
$row111 = (mysqli_query($con, $sql)) ;
    


    echo "<script>alert('Order status updated successfully!'); window.location.href = 'test-queary.php';</script>";
    exit;
}