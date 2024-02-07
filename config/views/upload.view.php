<?php

function checkUploadErrors()
{
    if (isset($_SESSION["errors_upload"])) {
        $errors = $_SESSION["errors_upload"];
        if (isset($errors["empty_input"])) {
            echo '<p class="form_error">' . '*' . $errors["empty_input"] . '</p>';
        } elseif (isset($errors["invalid_upload"])) {
            echo '<p class="form_error">' . '*' . $errors["invalid_upload"] . '</p>';
        } elseif (isset($errors["upload_error"])) {
            echo '<p class="form_error">' . '*' . $errors["upload_error"] . '</p>';
        } elseif (isset($errors["upload_size"])) {
            echo '<p class="form_error">' . '*' . $errors["upload_size"] . '</p>';
        } elseif (isset($errors["upload_type"])) {
            echo '<p class="form_error">' . '*' . $errors["upload_type"] . '</p>';
        } elseif (isset($errors["upload_name"])) {
            echo '<p class="form_error">' . '*' . $errors["upload_name"] . '</p>';
        } elseif (isset($errors["empty_price"])) {
            echo '<p class="form_error">' . '*' . $errors["empty_price"] . '</p>';
        } elseif (isset($errors["empty_productName"])) {
            echo '<p class="form_error">' . '*' . $errors["empty_productName"] . '</p>';
        } elseif (isset($errors["empty_description"])) {
            echo '<p class="form_error">' . '*' . $errors["empty_description"] . '</p>';
        }
    }
}


function generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice,$description)
{
    $html = "<div class='product-item'>";
    $html .= "<a href='$productLink'><img src='$imageSrc' alt='$productName'></a>";
    $html .= "<div class='product-name'>$productName</div>";
    $html .= "<div class='product-price'>$productPrice</div>";
    $html .= "<div class='product-description'>$description</div>";


    



    if (isset($_SESSION['email'])) {

        $html .= "<form action='add-to-cart.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='add' class='add-to-cart-btn' data-product-id='$id'>Add to Cart</button>";
        $html .= "</form>";
    } else {
        // If user is not logged in or doesn't have necessary privileges, display login prompt
        $html .= "<form action='login.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='add' class='add-to-cart-btn' data-product-id='$id'>Add to Cart  ♡
        </button>";
        $html .= "</form>";
    }

    if (isset($_SESSION['email'])) {
        
        $html .= "<form action='wishlist-button.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='wishlist' onClick='addToWishlist()' class='add-to-cart-btn' data-product-id='$id'>ADD to Wishlist</button>";
        $html .= "</form>";
    } else {
        // If user is not logged in or doesn't have necessary privileges, display login prompt
        $html .= "<form action='login.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='wishlist'  onClick='addToWishlist()' class='add-to-cart-btn' data-product-id='$id'>ADD to Wishlist</button>";
        $html .= "</form>";
    }

    if (isset($_SESSION['email'])) {
    if(($_SESSION["userType"] === "admin") || ($_SESSION["userType"] === "superadmin")){
        $html .= "<form action='delete.php' method='post'>";
        $html .= "<input type='hidden' name='product_id' value='$id'>";
        $html .= "<button name='delete'   class='add-to-cart-btn' data-product-id='$id'>Delete</button>";
        $html .= "</form>";

    }}

    
    $html .= "</div>";

    echo $html;
}




function showAllPromotion()
{
    $promotion = $_SESSION["Promotion"];
    foreach ($promotion as $row) {
        $id = $row["id"];
        $imageSrc = "uploads/" . $row["fileName"];
        $productLink = "product-info.php";
        $productName = $row["productName"];
        $productPrice = "LKR " . $row["price"];
        $description = $row["description"];
       
        generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice, $description);
    }
}

function showAllHeart()
{
    $heart = $_SESSION["Heart"];
    foreach ($heart as $row) {
        $id = $row["id"];
        $imageSrc = "uploads/" . $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR " . $row["price"];
        $description = $row["description"];
        generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice,$description);
    }
}

function showAllEyes()
{
    $eyes = $_SESSION["Eyes"];
    foreach ($eyes as $row) {
        $id = $row["id"];
        $imageSrc = "uploads/" . $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR " . $row["price"];
        $description= $row["description"];
        generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice,$description);
    }
}

function showAllPersonalCare()
{
    $personalCare = $_SESSION["PersonalCare"];
    foreach ($personalCare as $row) {
        $id = $row["id"];
        $imageSrc = "uploads/" . $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR " . $row["price"];
        $description = $row["description"];
        generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice,$description);
    }
}

function showAllDiabetes()
{
    $diabetes = $_SESSION["Diabetes"];
    foreach ($diabetes as $row) {
        $id = $row["id"];
        $imageSrc = "uploads/" . $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR " . $row["price"];
        $description = $row["description"];
        generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice,$description);
    }
}
