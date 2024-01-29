<?php
require_once 'config/config-session.php';
require_once 'config/views/upload.view.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Product Information</title>
    <style>

    </style>

</head>

<body>
    <div class="container">
        <?php
        checkUploadErrors();
        ?>

        <div class="mb-3 col-md-5 mx-auto">
            <h1 class="mt-4">New Products</h1>
        </div>
        <form action="config/add-new-products.inc.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-md-5 mx-auto">
                <label for="productName" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>

            <div class="mb-3 col-md-5 mx-auto">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" id="category" name="category">
                    <option value="Promotion">Promotion</option>
                    <option value="Heart">Heart</option>
                    <option value="Eyes">Eyes</option>
                    <option value="PersonalCare">Personal Care</option>
                    <option value="Diabetes">Diabetes</option>
                </select>
            </div>

            <div class="mb-3 col-md-5 mx-auto">
                <label for="quantity" class="form-label col-md-6 mx-auto">Quantity :</label>
                <input type="number" class="form-control col-md-6 mx-auto" id="quantity" name="quantity" required>
            </div>


            <div class="mb-3 col-md-5 mx-auto">
                <label for="price" class="form-label col-md-6 mx-auto">Price LKR:</label>
                <input type="number" class="form-control col-md-6 mx-auto" id="price" name="price" step="0.01" required>
            </div>

            <div class="mb-3 col-md-5 mx-auto">
                <label for="description" class="form-label col-md-6 mx-auto">Description (Max 200 characters):</label>
                <input type="text" class="form-control col-md-6 mx-auto" id="description" name="description" maxlength="200">
            </div>

            <div class="mb-3 col-md-5 mx-auto">
                <label for="productImage" class="form-label col-md-6 mx-auto">Choose a Product Image (550 X 750):</label>
                <input type="file" class="form-control col-md-6 mx-auto" id="productImage" name="productImage" accept="image/*" required>
            </div>
            <div class="mb-3 col-md-5 mx-auto">
                <button type="submit" class="btn btn-primary col-md-5 mx-auto" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>