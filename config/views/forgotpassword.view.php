<?php

declare(strict_types = 1);

function checkForgotPasswordErrors() {
    if (isset($_SESSION["errors_forgot_password"])) {
        $errors = $_SESSION["errors_forgot_password"];
        echo '<div class="alert alert-danger col-md-5 mx-auto">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
        echo '</div>';
        unset($_SESSION["errors_forgot_password"]);
    } else if(isset($_GET["reset"]) && $_GET["reset"] == "success") {
        echo '<div class="alert alert-success col-md-5 mx-auto">Reset Password Link was sent Successfully!</div>';
    }
}
