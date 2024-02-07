<?php

declare(strict_types=1);

require_once "config/components/error.component.php";

function showNameError()
{
    if (isset($_SESSION['errorsShipping'])) {
        $errors = $_SESSION['errorsShipping'];
        if (isset($errors["empty_name"])) {
            showError("empty name");
        }
    }
}

function showAddressError()
{
    if (isset($_SESSION['errorsShipping'])) {
        $errors = $_SESSION['errorsShipping'];
        if (isset($errors["empty_address"])) {
            showError("empty address");
        }
    }
}


function showPhoneError()
{
    if (isset($_SESSION['errorsShipping'])) {
        $errors = $_SESSION['errorsShipping'];
        if (isset($errors["empty_phone"])) {
            showError("empty phone");
        }
    }
}


function showCityError()
{
    if (isset($_SESSION['errorsShipping'])) {
        $errors = $_SESSION['errorsShipping'];
        if (isset($errors["empty_city"])) {
            showError("empty city");
        }
    }
}


function showZipError()
{
    if (isset($_SESSION['errorsShipping'])) {
        $errors = $_SESSION['errorsShipping'];
        if (isset($errors["empty_zip"])) {
            showError("empty zip");
        }
    }
}


function showCountryError()
{
    if (isset($_SESSION['errorsShipping'])) {
        $errors = $_SESSION['errorsShipping'];
        if (isset($errors["empty_country"])) {
            showError("empty country");
        }
    }
}


function showName($result)
{
    if (isset($result)) {
        return $result["ship_name"];
    } else {
        return "";
    }
}

function showEmail($result)
{
    if (isset($result)) {
        return $result["ship_email"];
    } else {
        return "";
    }
}


function showPhone($result)
{
    if (isset($result)) {
        return $result["ship_number"];
    } else {
        return "";
    }
}


function showAddress($result)
{
    if (isset($result)) {
        return $result["ship_address"];
    } else {
        return "";
    }
}


function showCity($result)
{
    if (isset($result)) {
        return $result["ship_city"];
    } else {
        return "";
    }
}


function showZip($result)
{
    if (isset($result)) {
        return $result["ship_zip"];
    } else {
        return "";
    }
}


function showCountry($result)
{
    if (isset($result)) {
        return $result["ship_country"];
    } else {
        return "";
    }
}
