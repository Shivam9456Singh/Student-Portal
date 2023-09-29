<?php
require_once "db.config.php";

if(isset($_SESSION['user_id'])!="") {
    header("Location: index.php");
}

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $guardians_name = mysqli_real_escape_string($conn, $_POST['Guardians_name']); // Fixed variable name
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $program = mysqli_real_escape_string($conn, $_POST['program']); // Added for program selection
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    
    $error = false; // Initialize error flag

    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $name_error = "Name must contain only alphabets and space";
        $error = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ID";
        $error = true;
    }
    if (strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
        $error = true;
    }
    if (strlen($mobile) < 10) {
        $mobile_error = "Mobile number must be minimum of 10 characters";
        $error = true;
    }
    if ($password != $cpassword) {
        $cpassword_error = "Password and Confirm Password doesn't match";
        $error = true;
    }

    if (!$error) {
        $password = md5($password);  // Encrypt password before insertion
        $sql = "INSERT INTO student(name, Guardians_name, email, mobile, address, program, password) 
                VALUES('$name', '$guardians_name', '$email', '$mobile','$address ', '$program', '$password')";

        if (mysqli_query($conn, $sql)) {
            header("location: login-student.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);


    if (mysqli_query($conn, $sql)) {
      // Send verification email
      $to = $email;
      $subject = "Successfully Registered";
      
      $message = "
      <html>
      <head>
      <title>Registration Details</title>
      </head>
      <body>
      <p>Thank you for registering!</p>
      <table>
      <tr>
      <th>Name</th>
      <td>$name</td>
      </tr>
      <tr>
      <th>Guardian's Name</th>
      <td>$guardians_name</td>
      </tr>
      <tr>
      <th>Email</th>
      <td>$email</td>
      </tr>
      <tr>
      <th>Mobile</th>
      <td>$mobile</td>
      </tr>
      <tr>
      <th>Address</th>
      <td>$address</td>
      </tr>
      <tr>
      <th>Program</th>
      <td>$program</td>
      </tr>
      </table>
      </body>
      </html>
      ";
      
      // Set content-type header for sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  
      // Additional headers
      $headers .= 'From: <webmaster@example.com>' . "\r\n"; // Replace with your email
  
      if(mail($to, $subject, $message, $headers)){
          echo "Verification email sent!";
      } else {
          echo "Failed to send verification email.";
      }
  
      header("location: login-student.php");
      exit();
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <div class="page-header">
          <h2 style="text-align:center;color:green; font-family:lucida console;">New Registration </h2>
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
              <input type="text" name="Guardians_name" class="form-control" value="" maxlength="50" required="" placeholder="Guardian's Name">
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
            <textarea name="address" class="form-control" rows="3" required="" placeholder="Enter your address"></textarea>
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
              <input type="password" name="password" class="form-control" value="" maxlength="100" required="" placeholder="Enter a Password.">
              <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
          </div>  

          <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" name="cpassword" class="form-control" value="" maxlength="100" required="" placeholder="Re-enter password.">
              <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
          </div>

          <div style="display: flex; justify-content: center;">
              <input type="submit" style="background-color:green; border-radius:5px; border-color:black;" class="btn btn-primary" name="signup" value="submit">
          </div>

          <b>Already have an account ?</b><a href="login-student.php" class="btn btn-default" style="color:green ;font-size:18px ; font-weight:500;">Login !</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>



