<?php

declare(strict_types = 1);

function checkForgotPasswordErrors() {
    if (isset($_SESSION["errors_create_newPassword"])) {

        $errors = $_SESSION["errors_create_newPassword"];
        echo '<div class="alert alert-danger col-md-5 mx-auto">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
        echo '</div>';
        unset($_SESSION["errors_create_newPassword"]);
        
    } else if(isset($_GET["reset"]) && $_GET["reset"] == "success") {
        echo '<div class="alert alert-success col-md-5 mx-auto">Password Reset Successfully!</div>';
    }
}
