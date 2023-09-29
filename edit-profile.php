<?php
session_start();
require_once "db.config.php";

// Check if user is not logged in
if(isset($_SESSION['user_id'])) {
    header("Location: login-student.php");
    exit;
}
// ... (at the top of your file after the database connection)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $guardians_name = $_POST['guardians_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $program = $_POST['program'];

    // Additional validation can be added here

    // Use a prepared statement to update the database
   $stmt = $conn->prepare("UPDATE student SET name=?, Guardians_name=?, email=?, mobile=?, address=?, program=? WHERE Student_id=?");

    $stmt->bind_param("ssssssi", $name, $guardians_name, $email, $mobile, $address, $program, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Update session variables if update is successful
        $_SESSION['user_name'] = $name;
        $_SESSION['guardians_name'] = $guardians_name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_mobile'] = $mobile;
        $_SESSION['user_address'] = $address;
        $_SESSION['user_program'] = $program;

        // Redirect to the profile page or display a success message
        header("Location: student-profile.php");
        exit;
    } else {
        // Handle error
        $error_message = "Error updating profile.";
    }

    $stmt->close();
}

// ... (rest of your HTML code)

// Handle the form submission and update logic here...

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Student Profile</title>
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

        label {
            color: #34495e;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 16px;
        }

        button[type="submit"] {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: green;
        }
    </style>
</head>

<body>

<div class="profile-container">
    <h2>Edit Student Profile</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Student Name:</label>
        <input type="text" name="name" id="name" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>">
        
        <label for="guardians_name">Guardian's Name:</label>
        <input type="text" name="guardians_name" id="guardians_name" value="<?php echo isset($_SESSION['guardians_name']) ? $_SESSION['guardians_name'] : ''; ?>">
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>">

        <label for="mobile">Phone No:</label>
        <input type="text" name="mobile" id="mobile" value="<?php echo isset($_SESSION['user_mobile']) ? $_SESSION['user_mobile'] : ''; ?>">
        
        <label for="address">Permanent Address:</label>
        <input type="text" name="address" id="address" value="<?php echo isset($_SESSION['user_address']) ? $_SESSION['user_address'] : ''; ?>">
        
        <label for="program">Registered Program:</label>
        <input type="text" name="program" id="program" value="<?php echo isset($_SESSION['user_program']) ? $_SESSION['user_program'] : ''; ?>">

        <!-- ... other fields ... -->

        <center><button type="submit" href="profile.php">Update Profile</button></center>
    </form>
</div>

</body>

</html>
