<?php

declare(strict_types=1);

include_once 'db.inc.php';

function getUserType(object $pdo, string $email) {
    $query = "SELECT 'admin' AS table_name, email FROM admin WHERE email = :input
              UNION ALL
              SELECT 'loginfo' AS table_name, email FROM loginfo WHERE email = :input
              UNION ALL
              SELECT 'superadmin' AS table_name, email FROM superAdmin WHERE email = :input;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':input', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getLoginfo(object $pdo, string $email) {
    $query = "SELECT * FROM loginfo WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getAdmin(object $pdo, string $email) {
    $query = "SELECT * FROM admin WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getSuperAdmin(object $pdo, string $email) {
    $query = "SELECT * FROM superAdmin WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

