<?php
session_start();
require_once "./includes/dbh.config.php";
$conn = Database::connect();


if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
}


if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }  

   $result = mysqli_query($conn, "SELECT * FROM student WHERE email = '" . $email. "' AND password = '" . md5($password). "' AND email_verified = 1");


   if(mysqli_num_rows($result) > 0){
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['user_id'] = $row['Student_id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['guardians_name'] = $row['Guardians_name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_mobile'] = $row['mobile'];
            $_SESSION['user_address'] = $row['address'];
            $_SESSION['user_program'] = $row['program'];
            header("Location: home.php");
        } 
    }else {
        $error_message = "Invalid Email or Password, email not verified !!";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Login</title>

     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="style.css">
</head>
<body>
<body>
  <div class="background-image">
    <img src="./assets/img/clg1.jpg" alt="">
  </div>
  <div class="container">
    <div class="center-box">
      <div class="col-lg-10">
        <div class="page-header">
          <h2 style="font-family:Verdana; margin-bottom:20px;text-align:center;">Login to your Account.</h2>
			
        </div>
        <p style="color:green; font-weight:500;">Enter registered user id and password. </p>
		  
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <!-- Your form fields -->
          <div class="form-group ">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="" maxlength="30" placeholder="   user@gmail.com"required="">
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="" maxlength="100" placeholder="  Enter Password"required="">
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>  
                    <p style="color:red;text-align:left;font-weight:700; font-family:sans-serif;"><?php echo "$error_message"; ?></p>
                    <div style="display: flex; justify-content: center;">
                     <input type="submit" style="background-color:green; border-radius:5px; border-color:black;" class="btn btn-primary" name="login" value="Login">
                    </div>
			
                    <b>Don't have account ?</b><a href="register-student.php" class="mt-3"> Create Account !</a>
        </form>
      </div>
		
    </div>
	  	<!-- Footer -->
  </div>

</body>


</body>
	
</html>

