<?php

function updateTextarea($id, $name, $value='', $placeholder = '', $class = '', $styles = '')
{
    $defaultStyles = "
        box-sizing: border-box;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    ";

    // Combine default styles with custom styles
    $combinedStyles = $defaultStyles . $styles;

    echo "<textarea id=\"$id\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" class=\"$class\" style=\"$combinedStyles\"></textarea>";
}