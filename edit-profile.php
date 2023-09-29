<?php
session_start();
require_once "./includes/dbh.config.php";
require './phpmailer/PHPMailerAutoload.php';
$conn = Database::connect();

// Start session




// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login-student.php");
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST['name']);
    $guardians_name = trim($_POST['guardians_name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $address = trim($_POST['address']);
    $program = trim($_POST['program']);
    // Add other fields as needed...

    // Validate the data here...

    // Update the database using a prepared statement
    $sql = "UPDATE student SET name=?, guardians_name=?, email=?, mobile=?, address=?, program=? WHERE Student_id=?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssi", $name, $guardians_name, $email, $mobile, $address, $program, $_SESSION['user_id']);
    
   if ($stmt->execute()) {
    // Update the session variables
    $_SESSION['user_name'] = $name;
    $_SESSION['guardians_name'] = $guardians_name;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_mobile'] = $mobile;
    $_SESSION['user_address'] = $address;
    $_SESSION['user_program'] = $program;
    // ... update other session variables if needed ...
	  			 $mail = new PHPMailer;

                 // Set mailer to use SMTP
                 $mail->isSMTP();
                 $mail->SMTPDebug =0;
                 $mail->Host = 'webmail.ggchmr.com';  // Specify your SMTP server
                 $mail->SMTPAuth = true;                         
                 $mail->Username='support.email@ggchmr.com';
                 $mail->Password='ggchmremail@123';       // SMTP password
                 $mail->SMTPSecure = 'ssl';                      // Use 'tls' or 'ssl'
                 $mail->Port = 465;  
                 $mail->SMTPOptions = array(
                 'ssl' => array(
                     'verify_peer' => false,
                     'verify_peer_name' => false,
                     'allow_self_signed' => true
                 )
             );
                 // Port number, usually 587 for tls and 465 for ssl
     
                 $mail->setFrom('your-email@example.com', 'Gautam Group of Colloges'); // Your email and name
                 $mail->addAddress($email);                       // Add a recipient (Student's email)
     
                 $mail->isHTML(true);   // Set email format to HTML
     
                 $mail->Subject = 'Student has been Successfully Registered ';
                 $mail->Body    = " Dear $name , <br><br>
                                   Thank you for registering !<br><br>
                                    <html>
           <head>
           <h3>Your Registration Details are : </h3>
           <style>
             body {
                 font-family:sans-serif;
                 margin: 10px;
             }
             table {
                 width: 50%;
                 border-collapse: collapse;
                 margin-top: 10px;
             }
             th, td {
                 padding: 15px;
                 text-align: left;
                 border-bottom: 1px solid #ddd;
             }
             th {
                 background-color:grey;
                 color: white;
                 font-size: 1.1em;
             }
             td {
                 color: #3333FF;
                 font-size: 1.2em;
             }
             tr:hover {
                 background-color: #f5f5f5;
             }
         </style>
           </head>
           <body>
           <table>
           <tr>
           <th>Student Name</th>
           <td>$name</td>
           </tr>
           <tr>
           <th>Guardian's Name</th>
           <td>$guardians_name</td>
           </tr>
           <tr>
           <th>Registered Email</th>
           <td>$email</td>
           </tr>
           <tr>
           <th>Registered Mobile</th>
           <td>$mobile</td>
           </tr>
           <tr>
           <th>Permanent Address</th>
           <td>$address</td>
           </tr>
           <tr>
           <th>Registered Program</th>
           <td>$program</td>
           </tr>
           </table>
           </body>
           </html>
           ";
	   
	  

    // Redirect to the profile page or display a success message
    header("Location: profile.php");
    exit;
} else {
    // Handle error
    echo "Error updating record: " . $stmt->error;
}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Student Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('./assets/img/clg1.jpg');
			background-size:cover;
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
		p{
			text-align:center;
			color:red;
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
		a.edit-link {
			text-decoration:none;
             display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
			margin-right:10px;
            border-radius: 4px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        a.edit-link:hover {
            background-color: green;
        }
    </style>
</head>

<body>

<div class="profile-container">
    <h2>Update Student Profile</h2>
	
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Student Name:</label>
        <input type="text" name="name" id="name" value="<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>"required>
        
        <label for="guardians_name">Guardian's Name:</label>
        <input type="text" name="guardians_name" id="guardians_name" value="<?php echo isset($_SESSION['guardians_name']) ? $_SESSION['guardians_name'] : ''; ?>"required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>"required>

        <label for="mobile">Phone No:</label>
        <input type="text" name="mobile" id="mobile" value="<?php echo isset($_SESSION['user_mobile']) ? $_SESSION['user_mobile'] : ''; ?>"required>
        
        <label for="address">Permanent Address:</label>
        <input type="text" name="address" id="address" value="<?php echo isset($_SESSION['user_address']) ? $_SESSION['user_address'] : ''; ?>"required>
        
        <label for="program">Registered Program:</label>
        <input type="text" name="program" id="program" value="<?php echo isset($_SESSION['user_program']) ? $_SESSION['user_program'] : ''; ?>"required>

        <!-- ... other fields ... -->

		<center><a href="profile.php" class="edit-link">Back</a><button type="submit" href="profile.php">Save</button>
		</center>
		
		
		
		
    </form>
	
</div>

</body>

</html>
