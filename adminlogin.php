<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin - Gautam Group Of College</title>
	
	<!-- meta tag -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- css file -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/form.css">
</head>
<body class="body-bg1">
	<div class="wrapper">
		<div class="wrap-center">
			<form method="Post" name="loginsubmit" action="includes/login.php">
				<h3 class="text-center">Login</h3>
				<div class="floating-box">
					<input class="inputText" type="email" name="email" placeholder=" " autocomplete="off" required />
					<label>Email Id</label>
				</div>
				<div class="floating-box">
					<input class="inputText" type="password" name="password" placeholder=" " autocomplete="off" required />
					<label>Password</label>
				</div>
				<div class="wrap-btn">
					<button class="login-btn"  name="loginsubmit">Login</button>
				</div>
				<div class="wrap-btn">
					<a class="back-btn" href="index.php">Home</a>
				</div>
			</form>
			<br>
			<div class="container">
					<?php 
						// Show any error or success message 
							if(isset($_SESSION['msg'])) {
								echo $_SESSION['msg'];
								session_unset();
							}
						?>
			</div>
			<br>
		</div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
</body>
</html>