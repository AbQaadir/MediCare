<?php 


function getData(){
    $con = mysqli_connect("localhost","root","","medicare");

    $sql = "SELECT * FROM products";

    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

?>