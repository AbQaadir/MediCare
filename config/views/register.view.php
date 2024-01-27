<?php

declare(strict_types = 1);

function displayErrors($error) {
    echo '<div class="alert alert-danger col-md-6 mx-auto">';
    echo '<ul>';
    echo '<li>' . $error . '</li>';
    echo '</ul>';
    echo '</div>';
}

function checkNameError() {
    if (isset($_SESSION['errorsRegister'])) {
        $errors = $_SESSION['errorsRegister'];
        if (isset($errors["empty_name"])) {
            displayErrors("Empty name");
        } elseif (isset($errors["invalid_name"])) {
            displayErrors("Invalid name");
        }

    }
}

function checkPhoneError() {
    if (isset($_SESSION['errorsRegister'])) {
        $errors = $_SESSION['errorsRegister'];
        if (isset($errors["empty_phone"])) {
            displayErrors("Empty phone");
        } elseif (isset($errors["invalid_phone"])) {
            displayErrors("Invalid phone");
        } elseif (isset($errors["used_phone"])) {
            displayErrors("Used phone");
        }
    }
}

function checkEmailError() {
    if (isset($_SESSION['errorsRegister'])) {
        $errors = $_SESSION['errorsRegister'];
        if (isset($errors["empty_email"])) {
            displayErrors("Empty email");
        } elseif (isset($errors["invalid_email"])) {
            displayErrors("Invalid email");
        } elseif (isset($errors["used_email"])) {
            displayErrors("Used email");
        }
    }
}

function checkPasswordError() {
    if (isset($_SESSION['errorsRegister'])) {
        $errors = $_SESSION['errorsRegister'];
        if (isset($errors["empty_password"])) {
            displayErrors("Empty password");
        } elseif (isset($errors["invalid_password"])) {
            displayErrors("Invalid password");
        }
    }
}


