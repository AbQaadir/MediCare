<?php

 require_once 'config/config-session.php';
 require_once 'config/db.inc.php';
 require_once 'config/models/admin.CURD.model.php';
 require_once 'config/views/admin.CURD.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Prodcut Page</title>
    <link rel="stylesheet" href="admin.products.css">

</head>
<body>
    <?php
    $results = getALLProductByEmail($pdo, $_SESSION['email']);
    foreach ($results as $result) {
        echo getProductHtml($result['id'], $result['productName'], $result['description'], $result['price'], $result['fileName']);
    }
    ?>
</body>
</html>