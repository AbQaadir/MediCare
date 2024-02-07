<?php

function generateProduct($id, $adminEmail, $imageSrc, $productLink, $productName, $productPrice)
{
    $html = "<div class='product-item'>";
    $html .= "<a href='$productLink'><img src='$imageSrc' alt='$productName'></a>";
    $html .= "<div class='product-name'>$productName</div>";
    $html .= "<div class='product-price'>$productPrice</div>";


    if (isset($_SESSION['email'])) {
        $html .= "<form action='config/add-to-cart.inc.php' method='post'>";
        $html .= "<input type='text' name='productId' value='$id'>";
        $html .= "<input type='text' name='adminEmail' value='$adminEmail'>";
        $html .= "<button name='add-to-cart' class='add-to-cart-btn' data-product-id='$id'>Add to Cart</button>";
        $html .= "</form>";
    } else {
        $html .= "<a href='login.php'><button class='add-to-cart-btn'>Add to Cart</button></a>";
    }

    $html .= "</div>";
    echo $html;
}
