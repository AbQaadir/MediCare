<?php

declare(strict_types=1);

function generateButton($text, $name = '', $onClick = '', $backgroundColor = '#3498db', $hoverColor = '#2980b9')
{
    // Button styling
    $style = "
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        color: #fff;
        background-color: $backgroundColor;
        transition: background-color 0.3s ease;
    ";

    // Hover effect styling
    $hoverStyle = "
        background-color: $hoverColor;
    ";

    // Output the button HTML
    echo "<button name=\"$name\" style=\"$style\" onmouseover=\"this.style.cssText='$style $hoverStyle'\" onmouseout=\"this.style.cssText='$style'\" onclick=\"$onClick\">$text</button>";
}
