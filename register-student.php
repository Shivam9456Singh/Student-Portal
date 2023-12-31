<?php
session_start();
require_once "./includes/dbh.config.php";
require './phpmailer/PHPMailerAutoload.php';
$conn = Database::connect();

if(isset($_SESSION['user_id'])!="") {
    header("Location: index.php");
}

$duplicate_error = ""; // Initialize error for duplicate entries

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $guardians_name = mysqli_real_escape_string($conn, $_POST['Guardians_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    
    $error = false; // Initialize error flag

    // Check for duplicate entries
    $checkDuplicateQuery = "SELECT * FROM student WHERE name = '$name' AND email = '$email' AND mobile = '$mobile'";
    $result = mysqli_query($conn, $checkDuplicateQuery);
    if(mysqli_num_rows($result) > 0) {
        $duplicate_error = "Student is Already Registered with same name , email or Mobile !";
        $error = true;
    }

    // ... rest of your validation logic ...

    if (!$error) {
     
    // Add a field for verification_code in your student table
		 $password = md5($password); 
		 $verification_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $sql = "INSERT INTO student(name, Guardians_name, email, mobile, address, program, password , verification_code) 
            VALUES('$name', '$guardians_name', '$email', '$mobile','$address ', '$program', '$password','$verification_code')";

        if (mysqli_query($conn, $sql)) {
           // ... your email sending code ...
                 // Send verification email using PHPMailer and SMTP
			

      		 $mail->Subject = 'Verify Your Email Address';
      		 $mail->Body = "Dear $name,<br><br>Thank you for registering! Please click the link below to verify your email:<br><a 						href='$verify_link'>$verify_link</a>";
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
                 $verify_link = "https://ggchmr.com/verify.php?code=$verification_code"; // Change to your actual domain
                 $mail->setFrom('your-email@example.com', 'Gautam Group of Colloges'); // Your email and name
                 $mail->addAddress($email);                       // Add a recipient (Student's email)
     
                 $mail->isHTML(true);   // Set email format to HTML
     
                 $mail->Subject = 'Student has been Successfully Registered ';
                 $mail->Body    = "Dear $name,<br><br>Thank you for registering! Please click the link below to verify your email:<br><a 						href='$verify_link'>click here to Verify Your Email ! </a><br><br>Verification code : <b>$verification_code</b>
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
              if(!$mail->send()) {
                     echo 'Failed to send verification email. Error: ' . $mail->ErrorInfo;
                 } else {
                     header("location: verify.php");
                     exit();
                 } 


        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>


<!-- ... Rest of your HTML code ... -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
  <div class="background-image">
    <img src="./assets/img/clg1.jpg" alt="">
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="page-header">
          <h2 style="text-align:center;color:green; font-family:lucida console;">New Registration </h2>
        </div>

        <!-- Display duplicate error message -->
        <p style="color: red;"><?php echo $duplicate_error; ?></p>

        <!-- ... Rest of your form ... -->
      </div>
    </div>
  </div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Full Name</label>
              <input type="text" name="name" class="form-control" value="" maxlength="50" required="" placeholder="Enter your full name.">
              <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
            </div>
            <div class="form-group col-md-6">
              <label>Guardian's Name</label>
              <input type="text" name="Guardians_name" class="form-control" value="" maxlength="50" required="" placeholder="Father's/ Guardian's Name">
              <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="" maxlength="30" required="" placeholder="username@gmail.com">
              <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
            </div>
            <div class="form-group col-md-6">
              <label>Mobile</label>
              <input type="text" name="mobile" class="form-control" value="" maxlength="10" required="" placeholder="+91">
              <span class="text-danger"><?php if (isset($mobile_error)) echo $mobile_error; ?></span>
            </div>
          </div>

            <div class="form-row">
            <div class="form-group col-md-12"> <!-- Made this span the full row for consistency -->
           <label>Address</label>
            <textarea name="address" class="form-control" rows="3" required="" placeholder="Enter permanent address"></textarea>
           <span class="text-danger"><?php if (isset($address_error)) echo $address_error; ?></span>
         </div>
          </div>

          <!--... Repeat the above pattern for other fields ...-->

          <div class="form-group">
            <label>Select a Program</label>
            <select name="program" class="form-control">
                <!-- Program options here (already provided in the previous answer) -->
                <optgroup label="UG">
            <option value="B.Sc.(MED./N-MED.)">B.Sc.(MED./N-MED.)</option>
            <option value="BCOM">BCOM</option>
            <option value="BA">BA</option>
            <option value="BBA">BBA</option>
            <option value="BHM">BHM</option>
            <option value="GNM">GNM</option>
            <option value="B.Sc .Nursing">B.Sc .Nursing</option>
        </optgroup>
        <optgroup label="PG">
            <option value="Post B.Sc. Nursing">Post B.Sc. Nursing</option>
            <option value="M.Sc. Botony">M.Sc. Botony</option>
            <option value="M.Sc. Biotechnology">M.Sc. Biotechnology</option>
            <option value="M.Sc. Chemistry">M.Sc. Chemistry</option>
            <option value="M.Sc. Physics">M.Sc. Physics</option>
            <option value="M.Sc. Mathematics">M.Sc. Mathematics</option>
            <option value="M.Sc. Microbiology">M.Sc. Microbiology</option>
            <option value="MA Pol. Sci.">MA Pol. Sci.</option>
        </optgroup>
        <optgroup label="Professional">
            <option value="BBA">BBA</option>
            <option value="BCA">BCA</option>
            <option value="MBA">MBA</option>
            <option value="PGDCA">PGDCA</option>
        </optgroup>
        <optgroup label="Pharmacy Courses">
            <option value="B. PHARMACY">B. PHARMACY</option>
            <option value="D. PHARMACY">D. PHARMACY</option>
        </optgroup>
            </select>
          </div>

          <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" value="" maxlength="100" required="" placeholder="Create a Password.">
              <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
          </div>  

          <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" name="cpassword" class="form-control" value="" maxlength="100" required="" placeholder="Re-enter password.">
              <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
          </div>

          <div style="display: flex; justify-content: center;">
              <input type="submit" style="background-color:green; border-radius:5px; border-color:black;" class="btn btn-primary" name="signup" value="Register">
          </div>

          <b>Already have Account ?</b><a href="login-student.php" class="mt-3"> Login !</a>
        </form>
      </div>
    </div>
	  	  	<!-- Footer 
<div class="footer" style="color:transparent">
    Developed by <a href="https://www.linkedin.com/in/shivam-singh-a19a32214/" target="_blank" style="color:transparent">Your Name</a>
</div> -->
  </div>
	
</body>
</html>




