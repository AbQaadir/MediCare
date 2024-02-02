<?php

function createUpload($pdo, $fileNameNew, $fileDestination, $productName, $description, $price, $category, $quantity)
{
    $query = "INSERT INTO products (fileName, fileDestination, productName, description, price, category, qty_p) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$fileNameNew, $fileDestination, $productName, $description, $price, $category, $quantity]);
}

function getProducts($pdo, $category)
{
    $query = "SELECT * FROM products WHERE category = :category;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();

    $result = $stmt->fetchAll();
    return $result;
}
