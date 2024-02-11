<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['delete_id'];

    try{
        require_once 'db.inc.php';
        require_once 'models/admin.CURD.model.php';

        deleteProduct($pdo, $id);

        header('Location: ../admin.products.php');
        $pdo = null;
        $stmt = null;
        exit();
        
    }catch(PDOException $e){
        echo $e->getMessage();
    }

} else {
    header('Location:../admin.products.php');
    exit();
}