<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keyword = $_POST['keyword'];

    try {
        require_once 'db.inc.php';
        require_once 'models/search.model.php';
        require_once 'controllers/search.contr.php';

        $errors = array();


        if (checkEmptyKeyword($keyword)) {
            $errors["empty_keyword"] = 'Keyword is required';
        }

        if (checkForbiddenKeywords($keyword)) {
            $errors["forbidden_keyword"] = 'Forbidden keyword';
        }

        if (checkSQLInjection($keyword)) {
            $errors["sql_injection"] = 'SQL Injection detected';
        }

        if ($errors) {
            $_SESSION['errorsSearch'] = $errors;
            header('Location: ../index.php');
            exit();
        }

        $products = searchProducts($pdo, $keyword);

        if ($products) {
            $_SESSION['products'] = $products;
            echo '<pre>';
            print_r($products);
            echo '</pre>';
            // header('Location: ../search.php');
            exit();
        } else {
            $_SESSION['noProducts'] = 'No products found';
            header('Location: ../search.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header('Location: ../index.php');
    exit();
}
