<?php

function createUpload($pdo, $fileNameNew, $fileDestination, $productName, $description, $price, $category, $quantity ,$adminEmail)
{
    $query = "INSERT INTO products (fileName, fileDestination, productName, description, price, category, qty_p , adminEmail) VALUES (?, ?, ?, ?, ?, ?, ?,?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$fileNameNew, $fileDestination, $productName, $description, $price, $category, $quantity,$adminEmail ]);
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

function deleteProduct($pdo, $id)
{
    $query = "DELETE FROM products WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $id);
    $stmt->execute();
}

function hasProductsByAdminEmail($pdo, $adminEmail)
{
    $query = "SELECT COUNT(*) FROM products WHERE adminEmail = :adminEmail;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':adminEmail', $adminEmail);
    $stmt->execute();

    $count = $stmt->fetchColumn();
    return $count > 0; // Return true if count is greater than 0, false otherwise
}







