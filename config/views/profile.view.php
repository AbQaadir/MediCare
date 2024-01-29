<?php

declare(strict_types=1);

function generateProfileHTML($name, $email, $phoneNumber)
{
    $html = "<div class='profile-page'>";
    $html .= "<h1>Profile</h1>";
    $html .= "<p>Name: <span id='name'>$name</span></p>";
    $html .= "<p>Email: <span id='email'>$email</span></p>";
    $html .= "<p>Phone number: <span id='phone-number'>$phoneNumber</span></p>";
    $html .= "<button id='delete-account-button'>Delete my account</button>";
    $html .= "</div>";

    echo $html;
}
