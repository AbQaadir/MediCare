<?php

declare(strict_types=1);

function setUser(object $pdo, string $email, string $password, string $name, string $phone_number) {
    $query = "INSERT INTO loginfo (email, password, name, phone_number) VALUES (:email, :password, :name, :phone_number);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);

    $options = [
        'cost' => 12
    ];

    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->execute();
}


function getEmail(object $pdo, string $email) : array|false {
    $query = "SELECT 'admin' AS table_name, email FROM admin WHERE email = :email
              UNION ALL
              SELECT 'loginfo' AS table_name, email FROM loginfo WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getPhone(object $pdo, string $phone_number): array|false {
    $query = "SELECT 'admin' AS table_name, email FROM admin WHERE phone_number = :phone_number
              UNION ALL
              SELECT 'loginfo' AS table_name, email FROM loginfo WHERE phone_number = :phone_number;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}