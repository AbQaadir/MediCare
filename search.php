<?php

require_once 'config/config-session.php';
require_once 'config/views/search.view.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="search.css">
</head>

<body>
    <main>
    <div style="display: block; justify-content: center; text-align: center;">
    <h1>Search results</h1>
</div>

        <div class="row">
            <?php
            if (isset($_SESSION['noProducts'])) {
                noSearchResults();
                unset($_SESSION['noProducts']);
            } else {
                $products = $_SESSION['products'];
                showAllSearchResults($products);
            }
            ?>
        </div>
    </main>
</body>

</html>