<?php

function isUploadEmpty($file) {
    return empty($file);
}

function isUploadInvalid($file) {
    return !is_array($file);
}

function isUploadError($file) {
    return $file["error"] !== 0;
}

function isUploadSizeInvalid($file) {
    return $file["size"] > 1000000;
}

function isUploadTypeInvalid($file) {
    $allowed = ["jpg", "jpeg", "png", "pdf"];
    $fileExt = explode(".", $file["name"]);
    $fileActualExt = strtolower(end($fileExt));
    return !in_array($fileActualExt, $allowed);
}

function isUploadNameInvalid($file) {
    $fileNameNew = $file["name"];
    $fileDestination = "../uploads/" . $fileNameNew;
    return !move_uploaded_file($file["tmp_name"], $fileDestination);
}

function isProductNameEmpty($productName) {
    return empty($productName);
}

function isDescriptionEmpty($description) {
    return empty($description);
}

function isPriceEmpty($price) {
    return empty($price);
}

