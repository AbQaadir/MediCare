<?php

function createUpload($pdo, $fileNameNew, $fileDestination, $productName, $description, $price, $category) {
    $query = "INSERT INTO products (fileName, fileDestination, productName, description, price, category) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$fileNameNew, $fileDestination, $productName, $description, $price, $category]);
}

function getProducts($pdo, $category) {
    $query = "SELECT * FROM products WHERE category = :category;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();

    $result = $stmt->fetchAll();
    return $result;
}