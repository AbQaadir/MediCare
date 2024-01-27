<?php

declare(strict_types=1);

function getAllUsers(object $pdo): array|false {
    $query = "SELECT * FROM loginfo;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}