<?php

declare(strict_types=1);



function viewUsersSample($result) {
    if ($result) {
        foreach ($result as $row) {
            $name = htmlspecialchars($row['name']);
            $email = htmlspecialchars($row['email']);
            $phone_number = htmlspecialchars($row['phone_number']);
            
            echo '<tr>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $phone_number . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="2">No Users found!</td></tr>';
    }
}


