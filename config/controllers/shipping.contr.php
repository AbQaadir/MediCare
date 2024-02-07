<?php

declare(strict_types=1);

function isShipNameEmpty($ship_name): bool
{
    if (empty($ship_name)) {
        return true;
    } else {
        return false;
    }
}


function isShipAddressEmpty($ship_address): bool
{
    if (empty($ship_address)) {
        return true;
    } else {
        return false;
    }
}


function isEmailAlreadyExist(object $pdo, string $email): bool
{
    if (checkEmail($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}


function isShipPhoneEmpty($ship_phone): bool
{
    if (empty($ship_phone)) {
        return true;
    } else {
        return false;
    }
}

function isShipCityEmpty($ship_city): bool
{
    if (empty($ship_city)) {
        return true;
    } else {
        return false;
    }
}

function isShipZipEmpty($ship_zip): bool
{
    if (empty($ship_zip)) {
        return true;
    } else {
        return false;
    }
}

function isShipCountryEmpty($ship_country): bool
{
    if (empty($ship_country)) {
        return true;
    } else {
        return false;
    }
}
