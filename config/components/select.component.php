<?php

function generateSelect($id, $name, $options, $class = '', $styles = '')
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

    echo "<select id=\"$id\" name=\"$name\" class=\"$class\" style=\"$combinedStyles\">";

    foreach ($options as $value => $label) {
        echo "<option value=\"$value\">$label</option>";
    }

    echo "</select>";
}
