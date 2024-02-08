<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Button Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .button-container {
            text-align: center;
        }

        .stylish-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .stylish-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <button class="stylish-button"><a href="add-new-products.php">Add Product</a></button>   
    </div>
    <br>
    <div class="button-container">
        <button class="stylish-button"><a href="admin.products.php">View all you uploaded products</a></button>
    </div>
</body>
</html>
