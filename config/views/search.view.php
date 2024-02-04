<?php

declare(strict_types=1);

function checkSearchErrors()
{
    if (isset($_SESSION['errorsSearch'])) {
        $errors = $_SESSION['errorsSearch'];
        if (isset($errors['empty_keyword'])) {
            echo "<div class='error-message'>" . $errors['empty_keyword'] . "</div>";
        }
        if (isset($errors['forbidden_keyword'])) {
            echo "<div class='error-message'>" . $errors['forbidden_keyword'] . "</div>";
        }
        if (isset($errors['sql_injection'])) {
            echo "<div class='error-message'>" . $errors['sql_injection'] . "</div>";
        }
    }
}


function noSearchResults()
{
    if (isset($_SESSION['noProducts'])) {
        echo "<h1>No search results found</h1>";
        unset($_SESSION['noProducts']);
    }
}



function searchProductHTML($id, $imageSrc, $productLink, $productName, $productPrice)
{
    $html = "<div class='product-item'>";
    $html .= "<a href='$productLink'><img src='$imageSrc' alt='$productName'></a>";
    $html .= "<div class='product-name'>$productName</div>";
    $html .= "<div class='product-price'>$productPrice</div>";



    if (isset($_SESSION['email'])) {
        $html .= "<form action='add-to-cart.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='add' class='add-to-cart-btn' data-product-id='$id'>Add to Cart</button>";
        $html .= "</form>";
    } else {
        // If user is not logged in or doesn't have necessary privileges, display login prompt
        $html .= "<form action='login.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='add' class='add-to-cart-btn' data-product-id='$id'>Add to Cart</button>";
        $html .= "</form>";
    }

    $html .= "</div>";
    echo $html;
}



function showAllSearchResults(array $results)
{
    foreach ($results as $result) {
        $id = $result['id'];
        $imageSrc = "uploads/" . $result['fileName'];
        $productLink = "product.php?id=$id";
        $productName = $result['productName'];
        $productPrice = $result['price'];

        searchProductHTML($id, $imageSrc, $productLink, $productName, $productPrice);
    }
}
