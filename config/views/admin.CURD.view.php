<?php

declare(strict_types=1);

function showProduct($id, $productName, $productDescription, $productPrice, $productImage)
{
    echo "<div class='col-4'>";
    echo "<div class='card'>";
    echo "<img src='images/$productImage' class='card-img-top' alt='...'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>$productName</h5>";
    echo "<p class='card-text'>$productDescription</p>";
    echo "<p class='card-text'>$productPrice</p>";
    echo "form action='update.php' method='post'>";
    echo "<a href='delete.php?id=$id' class='btn btn-danger'>Delete</a>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
