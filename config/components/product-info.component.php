<?php

function generateProductComponent($id, $imageSrc, $category, $quantity, $productName, $productDescription, $sellerName, $contactSellerLink, $price)
{
    $html = '<main class="container">';
    $html .= '    <div class="left-column">';
    $html .= '        <img data-image="black" src="' . $imageSrc . '" alt="">';
    $html .= '    </div>';
    $html .= '    <div class="right-column">';
    $html .= '        <div class="product-description">';
    $html .= '            <span>' . $category . '</span>';
    $html .= '            <h1>' . $productName . '</h1>';
    $html .= '            <p>' . $productDescription . '</p>';
    $html .= '            <h2>Stock : ' . $quantity . '</h2>';
    $html .= '        </div>';
    $html .= '        <div class="product-configuration">';
    $html .= '            <div class="product-color">';
    $html .= '                <span>Seller</span>';
    $html .= '                <div class="color-choose">';
    $html .= '                    <span>' . $sellerName . '</span>';
    $html .= '                </div>';
    $html .= '            </div>';
    $html .= '            <div class="cable-config">';
    $html .= '                <div class="cable-choose">';
    $html .= '                    <button><a href="mailto:' . $contactSellerLink . '">Contact seller via Email</a></button>';
    $html .= '                </div>';
    $html .= '                <a href="#">How to use the medicine</a>';
    $html .= '            </div>';
    $html .= '        </div>';
    $html .= '        <div class="product-price">';
    $html .= '            <span> LKR ' . $price . '</span>';

    if (isset($_SESSION['email'])) {
        $html .= "<form action='add-to-cart.php' method='post'>";
        $html .= "<input type='hidden' name='productId' value='$id'>";
        $html .= '<a href="#" class="cart-btn">Add to cart</a>';
        $html .= "</form>";
    } else {
        $html .= "<a href='login.php'><button class='add-to-cart-btn'>Add to Cart</button></a>";
    }

    $html .= '        </div>';
    $html .= '    </div>';
    $html .= '</main>';

    echo $html;
}
