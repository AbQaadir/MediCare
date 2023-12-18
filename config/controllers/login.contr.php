<?php

declare(strict_types=1);

function isEmptyEmail(string $email): bool {
    if (empty($email)) {
        return true;
    } else {
        return false;
    }
}

function isEmptyPassword(string $password): bool {
    if (empty($password)) {
        return true;
    } else {
        return false;
    } 
}

function isValidEmail(string $email): bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function isEmailWrong(bool|array $result) {
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

function isPasswordWrong(string $password, string $hashed_password) {
    if (!password_verify($password, $hashed_password)) {
        return true;
    } else {
        return false;
    }
}