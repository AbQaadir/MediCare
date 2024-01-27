<?php

declare(strict_types=1);

function checkEmailError() {
    if (isset($_SESSION['errorsLogin'])) {
        $errors = $_SESSION['errorsLogin'];
        if (isset($errors["empty_email"])) {
            echo '<div class="alert alert-danger col-md-5 mx-auto">';
            echo '<ul>';
            echo '<li>' . $errors["empty_email"] . '</li>';
            echo '</ul>';
            echo '</div>';
        } elseif (isset($errors["invalid_email"])) {
            echo '<div class="alert alert-danger col-md-5 mx-auto">';
            echo '<ul>';
            echo '<li>' . $errors["invalid_email"] . '</li>';
            echo '</ul>';
            echo '</div>';
        }
    }
}

function checkPasswordError() {
    if (isset($_SESSION['errorsLogin'])) {
        $errors = $_SESSION['errorsLogin'];
        if (isset($errors["empty_password"])) {
            echo '<div class="alert alert-danger col-md-5 mx-auto">';
            echo '<ul>';
            echo '<li>' . $errors["empty_password"] . '</li>';
            echo '</ul>';
            echo '</div>';
        } elseif (isset($errors["wrong_password"])) {
            echo '<div class="alert alert-danger col-md-5 mx-auto">';
            echo '<ul>';
            echo '<li>' . $errors["wrong_password"] . '</li>';
            echo '</ul>';
            echo '</div>';
        }

    }
}
