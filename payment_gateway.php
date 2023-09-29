<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once "./includes/dbh.config.php";
$conn = Database::connect();

// Check if user is already logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login-student.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['transaction_image'])) {
    $studentId = $_SESSION['user_id'];
    $imageName = $_FILES['transaction_image']['name'];
    $mimeType = $_FILES['transaction_image']['type'];
    
    // Check if file is an image
    $mimeType = $_FILES['transaction_image']['type'];
if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
    echo "Invalid MIME type: " . $mimeType;
    exit;
}


    // Read image data into a variable
    $imageData = file_get_contents($_FILES['transaction_image']['tmp_name']);

    $stmt = $conn->prepare("UPDATE students SET transaction_image = ?, mime_type = ?, image_data = ? WHERE Student_id = ?");
    $stmt->execute([$imageName, $mimeType, $imageData, $studentId]);
	
	if (!$stmt->execute([$imageName, $mimeType, $imageData, $studentId])) {
    die("Error executing the query: " . implode(", ", $stmt->errorInfo()));
}

    
    header("Location: payment_successfull.php");
    exit;
}

$programName = $_SESSION['user_program'];
if (($programName == "D. PHARMACY")||($programName == "B. PHARMACY")||($programName == "Post B.Sc. Nursing")||($programName == "B.Sc .Nursing")||($programName == "B.Sc.(MED./N-MED.)")) {
    $qrImage = "./assets/img/NURSING_QR.jpg";
} else{
    $qrImage = "assets/img/GC_HAMIRPUR_QR.jpg";
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Pay Fees</title>
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
            display: flex; /* Flexbox */
            justify-content: space-between; /* Place children with space in between */
        }

        .form-content {
            flex: 1; /* Take available space */
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
			font-size:17px;
        }
		button.edit-link-button {
     		 display: inline-block;
            
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
}

button.edit-link-button:hover {
   background-color: green;
	cursor:pointer;
	font-size:14px;
}

		

        .qr-code {
            width: 100px;
            align-self: center; /* Center in flex container */
        }

        input[type="text"], input[type="email"], input[type="tel"] {
            padding: 10px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            font-size: 16px;
            color: #7f8c8d;
            width: 50%;
        }
        div.profile-container {
    /* ... existing styles ... */
    align-items: stretch; /* Ensure children stretch to full height */
}

.form-content {
    flex: 2; /* This will ensure form-content takes twice the space as qr-code */
    /* ... existing styles ... */
}

.qr-code {
    flex: 1; /* This allows it to take up remaining space */
    display: flex;
    align-items: center; /* Vertically center the image */
    justify-content: center; /* Horizontally center the image */
    padding: 10px; /* Some padding around the image */
}

.qr-code img {
   
}

    </style>
	<script>
        function validateForm() {
            var image = document.forms["paymentForm"]["transaction_image"].value;
            if (image == "") {
                alert("Please upload the transaction image before submitting.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>

<div class="profile-container">
    <div class="form-content">
        <h2>Pay Fees</h2>
        <p style="color:red;">Payment Gateway Under Development ! Don't Use it now </p>
        <p style="color:red; font-size:11px;"><span>Instructions:</span><br>Step 1 : Scan the QR code and Pay Fees According to the Fees Structure. <br>
            Step 2 : Upload the Transaction ScreenShot . <br>
            Step 3 : Click on Submit  </p>
        
            <form action="" method="post">
    <p><span class="label">Student Name:</span> 
        <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>
        <!-- Hidden input to pass the value to the processing script -->
        <input type="hidden" name="user_name" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>">
    </p>
    
    <p><span class="label">Guardian's Name:</span> 
        <?php echo isset($_SESSION['guardians_name']) ? $_SESSION['guardians_name'] : ''; ?>
        <!-- Hidden input to pass the value to the processing script -->
        <input type="hidden" name="guardians_name" value="<?php echo isset($_SESSION['guardians_name']) ? $_SESSION['guardians_name'] : ''; ?>">
    </p>
				
<p><span class="label">Program Name:</span> 
    <?php echo isset($_SESSION['user_program']) ? $_SESSION['user_program'] : '';  ?>
    <!-- Hidden input to pass the value to the processing script -->
    <input type="hidden" name="program" value="<?php echo isset($_SESSION['user_program']) ? $_SESSION['user_program'] : ''; ?>">
</p>

    
    <p><span class="label">Upload Transaction Image:</span> 
        <input type="file" name="transaction_image" accept="image/*" required>
    </p>

    <!-- ... other details ... -->
    <a href="logout-student.php" class="edit-link">Logout</a>
				 <a href="profile.php" class="edit-link">Back</a>
				
  
    <a href="fee-structure.html" class="edit-link">Fees Structure</a>
				
				<button type="submit" class="edit-link-button">Submit</button>

    
</form>

        
    </div>
    

    <!-- QR Code Image on the right -->
    <!-- QR Code Image on the right -->
<img src="<?php echo $qrImage; ?>" alt="QR Code" class="qr-code">

</div>

</body>

</html>
