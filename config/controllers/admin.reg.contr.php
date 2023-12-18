<?php
declare(strict_types=1);

// check that input felids are empty

function isEmptyName(string $name): bool {
    if (empty($name)) {
        return true;
    } else {
        return false;
    }
}

function isEmptyEmail(string $email): bool {
    if (empty($email)) {
        return true;
    } else {
        return false;
    }
}

function isEmptyPhone(string $phone_number): bool {
    if (empty($phone_number)) {
        return true;
    } else {
        return false;
    }
}
function isEmptyPassword(string $password, string $confirmPassword): bool {
    if (empty($password) || empty($confirmPassword)) {
        return true;
    } else {
        return false;
    } 
}

// check that input fields are valid

function isValidName(string $name): bool {
    if (strlen($name) < 3 || strlen($name) > 255) {
        return false;
    } else {
        return true;
    }
}

function isValidEmail(string $email): bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function isValidSriLankanPhone(string $phone_number): bool {
    // Allow Sri Lankan phone numbers with or without dashes
    if (!preg_match('/^(?:\+94|0)[1-9][0-9]{8}$/', $phone_number)) {
        return false;
    } else {
        return true;
    }
}


function isValidPassword(string $password, string $confirmPassword): bool {
    if ($password !== $confirmPassword) {
        return false;
    }
    return true;
}

// check that email is not already in use in Loginfo table

function isEmailInUseLoginfo(object $pdo, string $email) {
    $result = getLoginfoEmail($pdo, $email);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

// check that email is not already in use Admin table

function isEmilInUseAdmin(object $pdo, string $email) {
    $result = getAdminEmail($pdo, $email);
    if ($result) {
        return true;
    } else {
        return false;
    }
}





