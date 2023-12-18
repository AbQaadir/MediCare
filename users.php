<?php
require_once 'config/config-session.php';

try {
    require_once 'config/db.inc.php';
    require_once 'config/models/user.list.model.php';

    $result = getAllUsers($pdo);
    $_SESSION["result"] = $result;

    require_once 'config/views/user.list.view.php';
} catch (PDOException $e) {
    die("Could not connect. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #ddd;
            background-color: #fff;
            color: #333;
        }

        .pagination .active {
            background-color: #4CAF50;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <h2>User List</h2>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Users Names</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    viewUsersSample($_SESSION["result"]);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>