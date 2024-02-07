<?php

declare(strict_types=1);

function searchProducts(PDO $pdo, string $keyword): array|false
{
    // Prepare the SQL query with placeholders
    $query = "SELECT * FROM products WHERE LOWER(productName) LIKE LOWER(:keyword) OR LOWER(description) LIKE LOWER(:keyword)";

    // Bind the keyword parameter
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Check if any rows were returned
    if ($stmt->rowCount() > 0) {
        // Fetch the rows and return the results
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    } else {
        // No matching items found or an error occurred
        return false;
    }
}
