<?php
include 'class.user.php';

	if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['loginsubmit']))){
        $user = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $result = $user->admin_login($email,$password);
		if($result){
			echo '<script>window.location = "../adminhome.php"</script>';
		} else {
			$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed</strong>
		</div>';
			echo '<script>window.location = "../adminlogin.php"</script>';
		}
	}
?>