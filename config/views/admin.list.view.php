<?php

declare(strict_types=1);

function viewAdminSample($result) {
    if ($result) {
        foreach ($result as $row) {
            $name = htmlspecialchars($row['name']);
            $email = htmlspecialchars($row['email']);
            $phone_number = htmlspecialchars($row['phone_number']);
            
            echo '<tr class="candidates-list">';
            echo '<td class="title">';
            echo '<div class="thumb">';
            echo '<img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">';
            echo '</div>';
            echo '<div class="candidate-list-details">';
            echo '<div class="candidate-list-info">';
            echo '<div class="candidate-list-title">';
            echo '<h5 class="mb-0"><a href="#">' . $name . '</a></h5>';
            echo '</div>';
            echo '<div class="candidate-list-option">';
            echo '<ul class="list-unstyled">';
            echo '<li><i class="fas fa-filter pr-1"></i>'.$phone_number. '</li>';
            echo '<li><i class="fas fa-map-marker-alt pr-1"></i>' . $email. '</li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</td>';
            echo '<td class="candidate-list-favourite-time text-center">';
            echo '<a class="candidate-list-favourite order-2 text-danger" href="#"><i class="fas fa-heart"></i></a>';
            echo '<span class="candidate-list-time order-1">Shortlisted</span>';
            echo '</td>';
            echo '<td>';
            echo '<ul class="list-unstyled mb-0 d-flex justify-content-end">';
            echo '<li><a href="#" class="text-primary" data-toggle="tooltip" title="" data-original-title="view"><i class="far fa-eye"></i></a></li>';
            echo '<li><a href="#" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>';
            echo '<li><a href="#" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>';
            echo '</ul>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo 'No Users found!';
    }
}
