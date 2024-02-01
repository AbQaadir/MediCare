<?php
session_start();

// Connect to database
$con = mysqli_connect("localhost", "root", "", "medicare");

// Retrieve user details from POST data
$name = $_POST['name'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];

// Insert user details into database
$sql = "INSERT INTO user_details (name, email, telephone, address) VALUES ('$name', '$email', '$telephone', '$address')";
if (mysqli_query($con, $sql)) {
    echo "User details stored successfully.";
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);

