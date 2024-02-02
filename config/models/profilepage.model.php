<?php

declare(strict_types=1);

function getUser($pdo, $email): array|false
{
    try {
        $sql = "SELECT * FROM loginfo WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user;
    } catch (PDOException $e) {
        return false;
    }
}

function getAdmin($pdo, $email): array|false
{
    try {
        $sql = "SELECT * FROM admin WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user;
    } catch (PDOException $e) {
        return false;
    }
}


function deleteUser($pdo, $email): bool
{
    try {
        $sql = "DELETE FROM loginfo WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}


function deleteAdmin($pdo, $email): bool
{
    try {
        $sql = "DELETE FROM admin WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
