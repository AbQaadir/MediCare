<?php

declare(strict_types=1);

function getUser($pdo, $email): array|false
{
    try {
        $sql = "SELECT * FROM loginfo WHERE email = :email
                UNION
                SELECT * FROM admin WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        return $user;
    } catch (PDOException $e) {
        return false;
    }
}
