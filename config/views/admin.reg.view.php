<?php

declare(strict_types = 1);

// check that Name input felids are empty

function checkNameError() {
    if (isset($_SESSION['errorsRegisterAdmin'])) {
        $errors = $_SESSION['errorsRegisterAdmin'];
        if (isset($errors["empty_name"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["empty_name"] .'</p>';
        } elseif (isset($errors["invalid_name"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["invalid_name"] .'</p>';
        }
    }
}

// check that Phone input fields are valid

function checkPhoneError() {
    if (isset($_SESSION['errorsRegisterAdmin'])) {
        $errors = $_SESSION['errorsRegisterAdmin'];
        if (isset($errors["empty_phone"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["empty_phone"] .'</p>';
        } elseif (isset($errors["invalid_phone"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["invalid_phone"] .'</p>';
        } else if (isset($errors["used_phone"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["used_phone"].'</p>';
        }
    }
}

// check that Email input fields are valid

function checkEmailError() {
    if (isset($_SESSION['errorsRegisterAdmin'])) {
        $errors = $_SESSION['errorsRegisterAdmin'];
        if (isset($errors["empty_email"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["empty_email"] .'</p>';
        } elseif (isset($errors["invalid_email"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["invalid_email"] .'</p>';
        } else if (isset($errors["used_email"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["used_email"] .'</p>';
        }
    }
}

// check that Password input fields are valid

function checkPasswordError() {
    if (isset($_SESSION['errorsRegisterAdmin'])) {
        $errors = $_SESSION['errorsRegisterAdmin'];
        if (isset($errors["empty_password"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["empty_password"] .'</p>';
        } elseif (isset($errors["invalid_password"])) {
            echo '<p class="form_error col-md-5 mx-auto">'. '*'.$errors["invalid_password"] .'</p>';
        }
    }
}

