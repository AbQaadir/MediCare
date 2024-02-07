<?php

declare(strict_types=1);

function checkEmail(object $pdo, string $email)
{
    $query = "SELECT * FROM shipping_info WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function recentShoppingInfo(object $pdo, string $email)
{
    $query = "SELECT * FROM shipping_info WHERE ship_email = :email ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function addShippingInfo(object $pdo, string $ship_name, string $ship_email, string $ship_phone, string $ship_address, string $ship_city, string $ship_zip, string $ship_country)
{
    $query = "INSERT INTO shipping_info (ship_name, ship_email, ship_phone, ship_address, ship_city, ship_zip, ship_country) VALUES (:ship_name, :ship_email, :ship_phone, :ship_address, :ship_city, :ship_zip, :ship_country)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':ship_name', $ship_name);
    $stmt->bindParam(':ship_email', $ship_email);
    $stmt->bindParam(':ship_phone', $ship_phone);
    $stmt->bindParam(':ship_address', $ship_address);
    $stmt->bindParam(':ship_city', $ship_city);
    $stmt->bindParam(':ship_zip', $ship_zip);
    $stmt->bindParam(':ship_country', $ship_country);
    $stmt->execute();
}
