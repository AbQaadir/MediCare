<?php

function checkUploadErrors() {
    if (isset($_SESSION["errors_upload"])) {
        $errors = $_SESSION["errors_upload"];
        if (isset($errors["empty_input"])) {
            echo '<p class="form_error">'. '*'.$errors["empty_input"] .'</p>';
        } elseif (isset($errors["invalid_upload"])) {
            echo '<p class="form_error">'. '*'.$errors["invalid_upload"] .'</p>';
        } elseif (isset($errors["upload_error"])) {
            echo '<p class="form_error">'. '*'.$errors["upload_error"] .'</p>';
        } elseif (isset($errors["upload_size"])) {
            echo '<p class="form_error">'. '*'.$errors["upload_size"] .'</p>';
        } elseif (isset($errors["upload_type"])) {
            echo '<p class="form_error">'. '*'.$errors["upload_type"] .'</p>';
        } elseif (isset($errors["upload_name"])) {
            echo '<p class="form_error">'. '*'.$errors["upload_name"] .'</p>';
        } elseif (isset($errors["empty_price"])) {
            echo '<p class="form_error">'. '*'.$errors["empty_price"] .'</p>';
        } elseif (isset($errors["empty_productName"])) {
            echo '<p class="form_error">'. '*'.$errors["empty_productName"] .'</p>';
        } elseif (isset($errors["empty_description"])) {
            echo '<p class="form_error">'. '*'.$errors["empty_description"] .'</p>';
        }
    }
}




function generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice) {
    $html = "<div class='product-item'>";
    $html .= "<a href='.$productLink.'><img src='".$imageSrc."' alt='".$productName."'></a>";
    $html .= "<a href='.$productLink.' class='product-name'>".$productName."</a>";
    $html .= "<div class='product-price'>LKR ".$productPrice."</div>";
    $html .= "</div>";

    echo $html;
}

function showAllPromotion(){
    $promotion = $_SESSION["Promotion"];
    foreach ($promotion as $row) {
        $imageSrc = "uploads/". $row["fileName"];
        $productLink = "product-info.php";
        $productName = $row["productName"];
        $productPrice = "LKR ".$row["price"];
        generateProductHTML($id, $imageSrc, $productLink, $productName, $productPrice);
    }
}

function showAllHeart(){
    $heart = $_SESSION["Heart"];
    foreach ($heart as $row) {
        $imageSrc = "uploads/". $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR ".$row["price"];
        generateProductHTML($imageSrc, $productLink, $productName, $productPrice);
    }
}

function showAllEyes(){
    $eyes = $_SESSION["Eyes"];
    foreach ($eyes as $row) {
        $imageSrc = "uploads/". $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR ".$row["price"];
        generateProductHTML($imageSrc, $productLink, $productName, $productPrice);
    }
}

function showAllPersonalCare() {
    $personalCare = $_SESSION["PersonalCare"];
    foreach ($personalCare as $row) {
        $imageSrc = "uploads/". $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR ".$row["price"];
        generateProductHTML($imageSrc, $productLink, $productName, $productPrice);
    }
}

function showAllDiabetes() {
    $diabetes = $_SESSION["Diabetes"];
    foreach ($diabetes as $row) {
        $imageSrc = "uploads/". $row["fileName"];
        $productLink = "#";
        $productName = $row["productName"];
        $productPrice = "LKR ".$row["price"];
        generateProductHTML($imageSrc, $productLink, $productName, $productPrice);
    }
}