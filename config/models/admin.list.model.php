<?php

declare(strict_types=1);

function getAllAdmins(object $pdo): array|false {
    $query = "SELECT * FROM admin;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}