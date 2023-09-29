<?php
session_start();
	if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['feedsubmit']))){
		$name = $_POST['name'];
		$emailfrom = $_POST['emailfrom'];
		$subject = $_POST['subject'];
		$mobileno = $_POST['mobileno'];
		$message = $_POST['message'];
		
		$mailto = "kumar05.962013@gmail.com";
		$headers = "From: ".$emailfrom;
		$txt = "You have received a e-mail from: .\n Name:".$name.".\n Mobile No:".$mobileno.".\n\n".$message;

		$mailconfir = mail($mailto, $subject, $txt, $headers);
		if($mailconfir){
			$_SESSION['mail-msg'] = '<div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success</strong>! Submit successful.
		</div>';
			echo '<script>window.location = "index.php#mail"</script>';
		} else {
			$_SESSION['mail-msg'] = '<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed</strong>
		</div>';
			echo '<script>window.location = "index.php#mail"</script>';
		}
	}
?>