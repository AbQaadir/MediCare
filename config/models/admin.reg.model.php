<?php

declare(strict_types=1);


// check that input felids are empty
function getLoginfoEmail(object $pdo, string $email) {
    $query = "SELECT * FROM loginfo WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// delete loginfo row by email
function deleteLoginfoEmail(object $pdo, string $email) {
    $query = "DELETE FROM loginfo WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

function getAdminEmail(object $pdo, string $email) {
    $query = "SELECT * FROM admin WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setAdmin(object $pdo, string $email, string $password, string $name, string $phone_number) {
    $query = "INSERT INTO admin (email, password, name, phone_number) VALUES (:email, :password, :name, :phone_number);";
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