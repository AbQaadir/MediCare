<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-dialog {
            width: 300px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .modal-title {
            color: #333;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            text-align: right;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h1>Log Out</h1>
        <form action="config/logout.inc.php" method="post">
            <button type="button" id="openModal">Log Out</button>
        </form>
    </div>

    <!-- Logout Modal -->
    <div class="modal" id="logoutModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log Out Confirmation</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <form action="config/logout.inc.php" method="post">
                    <div class="modal-footer">
                        <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Log Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle modal behavior
        document.getElementById('openModal').addEventListener('click', function () {
            document.getElementById('logoutModal').style.display = 'block';
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('logoutModal').style.display = 'none';
        });

        document.getElementById('cancelBtn').addEventListener('click', function () {
            document.getElementById('logoutModal').style.display = 'none';
        });
    </script>
</body>

</html>
