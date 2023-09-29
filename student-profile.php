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
    <title>Student Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('./assets/img/clg1.jpg');
            margin: 0;
            padding: 0;
        }

        div.profile-container {
            width: 60%;
            background-color: #fff;
            margin: 50px auto;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align:center;
            color:green;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        p {
            color: #7f8c8d;
            font-size: 18px;
            line-height: 2;
            border-bottom: 1px dotted #ecf0f1;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        p span.label {
            color: #34495e;
            font-weight: bold;
            margin-right: 20px;
            display: inline-block;
            width: 200px;
        }

        a.edit-link {
            display: inline-block;
            
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        a.edit-link:hover {
            background-color: green;
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <h2>Student Profile</h2>
       
        <p><span class="label">Student Name:</span> <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?></p>
        <p><span class="label">Guardian's Name:</span> <?php echo isset($_SESSION['guardians_name']) ? $_SESSION['guardians_name'] : ''; ?></p>
        <p><span class="label">Email:</span> <?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></p>
        <p><span class="label">Phone No. </span> <?php echo isset($_SESSION['user_mobile']) ? $_SESSION['user_mobile'] : ''; ?></p>
        <p><span class="label">Permanent Address:</span> <?php echo isset($_SESSION['user_address']) ? $_SESSION['user_address'] : ''; ?></p>
        <p><span class="label">Registered Program:</span> <?php echo isset($_SESSION['user_program']) ? $_SESSION['user_program'] : ''; ?></p>

        <!-- ... other details ... -->

        <center><a href="edit-profile.php" class="edit-link">Edit Profile</a></center>
        <a href="payment_gateway.php" class="edit-link">Pay Fees</a>
        <a href="logout-student.php" class="edit-link">Logout</a>
    </div>

</body>

</html>
