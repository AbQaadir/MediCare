<?php

declare(strict_types=1);

function generateProfileHTML($name, $email, $phoneNumber)
{
    $html = "<div class='profile-page'>";
    $html .= "<h1>Profile</h1>";
    $html .= "<p>Name: <span id='name'>$name</span></p>";
    $html .= "<p>Email: <span id='email'>$email</span></p>";
    $html .= "<p>Phone number: <span id='phone-number'>$phoneNumber</span></p>";
    $html .= "<button id='edit-address-button'>Add Address</button>";
    $html .= "<br>";
    $html .= "<form action='config/delete-profile.inc.php' method='post'>";
    $html .= "<input type='hidden' name='email' value='$email'>";
    $html .= "<input type='submit' value='Delete my account'>";
    $html .= "</form>";
    $html .= "</div>";

    echo $html;
}
