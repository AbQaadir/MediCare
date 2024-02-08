<?php

declare(strict_types=1);

function getProductHtml($id, $productName, $productDescription, $productPrice, $productImage)
{
    $html = <<<HTML
    <div class="col-4">
        <div class="card">
            <img src="uploads/{$productImage}" class="card-img-top" alt="{$productImage}">
            <div class="card-body">
                <h5 class="card-title">{$productName}</h5>
                <p class="card-text">{$productDescription}</p>
                <p class="card-text">{$productPrice}</p>
                <!-- <form action="update.php" method="post">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <input type="hidden" name="update_id" value="{$id}">
                </form> -->
                <form action="config/delete.inc.php" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <input type="hidden" name="delete_id" value="{$id}">
                </form>
            </div>
        </div>
    </div>
HTML;
    return $html;
}



