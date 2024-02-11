<?php

// $email = $_SESSION["email"];

// $sql="SELECT ship_email FROM shipping_info WHERE ship_email='$email'";

// $result=mysqli_query($con,$sql);

// $row=mysqli_fetch_assoc($result);


function updateInput($type = 'text', $name = '',$value = '', $placeholder = '',  $class = '', $styles = '')
{
    $defaultStyles = "
        box-sizing: border-box;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    ";

    // Combine default styles with custom styles
    $combinedStyles = $defaultStyles . $styles;

    echo "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\" value=\"$value\" class=\"$class\" style=\"$combinedStyles\">";
}
