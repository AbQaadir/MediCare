<?php

// Declare strict typing for the entire file
declare(strict_types = 1);

// Function to check if any of the input fields is empty
function isInputEmpty(string $password, string $password_confirm): bool {
    if (empty($password) || empty($password_confirm)) {
        return true;
    } else {
        return false;
    }
}

// Function to check if two passwords match
function isPasswordSame(string $password, string $password_confirm): bool {
    if ($password === $password_confirm) {
        return true;
    } else {
        return false;
    }
}

function isUrlValid(string $selector, string $validator) : bool {
    if (empty($selector) || empty($validator)) {
        return false; // Return false for invalid
    } elseif (ctype_xdigit($selector) === false || ctype_xdigit($validator) === false) {
        return false; // Return false for invalid
    } else {
        return true;  // Return true for valid
    }
}

function isUrlExpired(bool|array $result, int $currentTime): bool {
    if ($result["pwdResetExpires"] <= $currentTime) {
        return true;
    } else {
        return false;
    }
}

function isTokenValid(bool|array $result, string $validator): bool {
    // Check if the token in the result array matches the provided token
    $token = hex2bin($validator);
    if ($result["pwdResetToken"] == $token) {
        return true; // Return true for valid
    } else {
        return false; // Otherwise 
    }
}


function checkUserType(object $pdo, string $email) : string|false {
    $userResult = getUser($pdo, $email); // Assuming you have a function to fetch user info
    $adminResult = getAdmin($pdo, $email); // Assuming you have a function to fetch admin info

    if ($userResult) {
        return "loginfo"; // User found in 'loginfo' table
    } elseif ($adminResult) {
        return "admin"; // User found in 'admin' table
    } else {
        return false; // User not found in either table
    }
}

