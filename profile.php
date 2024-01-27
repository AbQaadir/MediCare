<?php 
    require_once 'config/config-session.php';

    try {
        require_once 'config/db.inc.php';
        require_once 'config/models/profilepage.model.php';

        $email = $_SESSION["email"];
        $result = getUser($pdo, $email);

        if ($result) {
            $name = $result["name"];
            $phone = $result["phone_number"];
        } else {
            $name = "Abdul Qaadir";
            $phone = "1234567890";
            
        }
        
        $name = $result["name"];
        $phone = $result["phone_number"];

    } catch (\Throwable $th) {
        //throw $th;
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            width: 600px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            margin: 50px auto;
        }

        h1 {
            font-size: 30px;
            color: #333;
            margin-bottom: 20px;
        }

        .lead {
            font-size: 18px;
            color: #777;
            margin-bottom: 10px;
        }
    </style>
    
</head>
<body>
    <div class="card">
        <h1><?php echo $name; ?></h1>
        <p class="lead">Email: <?php echo $email; ?></p>
        <p class="lead">Contact Number: <?php echo $phone; ?></p>
    </div>
</body>
</html>
