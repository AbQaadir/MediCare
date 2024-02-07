<?php

function showError($errorMessage)
{
    echo '<div style="background-color: #ffcccc; color: #ff0000; padding: 10px; border: 1px solid #ff0000; margin: 10px 0;">';
    echo '<strong>Error:</strong> ' . $errorMessage;
    echo '</div>';
}
