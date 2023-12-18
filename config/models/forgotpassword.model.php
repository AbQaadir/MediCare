<?php

declare(strict_types=1);

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

function getSuperAdmin(object $pdo, string $email) : array|false {
    $query = "SELECT * FROM superadmin WHERE email=:input";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':input', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function deleteUser(object $pdo, string $email) {
    $query = "DELETE FROM passwordreset WHERE pwdResetEmail=:input";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':input', $email);
    $stmt->execute();
}

function createPwdReset(object $pdo, string $email, string $selector, string $token, int $expires) {
    $query = "INSERT INTO passwordreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) 
    VALUES (:email, :selector, :token, :expires)";
    $stmt = $pdo->prepare($query);

    // Hash the password using bcrypt
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);

    // Bind parameters and execute the query
    $stmt->execute([
        ':email' => $email,
        ':selector' => $selector,
        ':token' => $hashedToken,
        ':expires' => $expires 
    ]);
}

