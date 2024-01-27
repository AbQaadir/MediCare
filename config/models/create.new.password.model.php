<?php

declare(strict_types=1);

function getRowData(object $pdo, string $selector) {

    $query = 'SELECT * FROM passwordreset WHERE pwdResetSelector = :selector;';
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':selector' => $selector,
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getUser(object $pdo, string $email) : array|false {
    $query = "SELECT * FROM loginfo WHERE email=:input";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':input', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getAdmin(object $pdo, string $email) : array|false {
    $query = "SELECT * FROM admin WHERE email=:input";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':input', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function editUser(object $pdo, string $email, string $password) {
    $query = "UPDATE loginfo SET password = :password WHERE email = :email;";
    $stmt = $pdo->prepare($query);

    // Set the cost factor for password hashing
    $options = [
        'cost' => 12
    ];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    // Bind parameters and execute the query
    $stmt->execute([
        ':email' => $email,
        ':password' => $hashed_password 
    ]);
}

function editAdmin(object $pdo, string $email, string $password) {
    $query = "UPDATE admin SET password = :password WHERE email = :email;";
    $stmt = $pdo->prepare($query);

    // Set the cost factor for password hashing
    $options = [
        'cost' => 12
    ];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

    // Bind parameters and execute the query
    $stmt->execute([
        ':email' => $email,
        ':password' => $hashed_password 
    ]);
}