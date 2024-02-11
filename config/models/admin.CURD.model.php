<?php

declare(strict_types=1);

// delete a product by id

function getALLProductByEmail(object $pdo, string $email): array
{
    $query = "SELECT * FROM products WHERE adminEmail = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function deleteProduct(object $pdo, int $id): void
{
    $query = "DELETE FROM products WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
