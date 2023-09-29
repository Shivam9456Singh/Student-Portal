<?php
session_start();
require_once "db.config.php";

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: login-student.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .success-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .tick {
            color: #2ecc71;
            font-size: 100px;
        }

        h1 {
            color: #2ecc71;
        }

        p {
            color: #7f8c8d;
            font-size: 18px;
        }
    </style>
</head>

<body>

<div class="success-container">
    <div class="tick">✓</div>
    <h1>Payment Successful</h1>

    <p> <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?><br>Thank you for your payment. Your transaction has been completed successfully.</p>


</div>

</body>

</html>
