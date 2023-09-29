<?php
session_start();
	if(($_SERVER['REQUEST_METHOD'] =='POST') AND (isset($_POST['feedsubmit']))){
		require 'phpmailer/PHPMailerAutoload.php';
		$name = $_POST['name'];
		$emailfrom = $_POST['emailfrom'];
		$subject = $_POST['subject'];
		$mobileno = $_POST['mobileno'];
		$message = $_POST['message'];
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host='webmail.ggchmr.com';
		$mail->SMTPAuth=true;
		$mail->SMTPSecure='ssl';
		$mail->Port=465;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		$mail->Username='support.email@ggchmr.com';
		$mail->Password='ggchmremail@123';

		$mail->setFrom('support.email@ggchmr.com','GGCHMR');
		$mail->addAddress('ggchmr@gmail.com');
		#$mail->addReplyTo($emailfrom,$name);

		$mail->isHTML(true);
		$mail->Subject='Subject: '.$subject;
		$mail->Body='<b>Sender Details</b>
					<br><br>
					<b>Name: '.$name.'</b>
					<br>
					<b>Email: '.$emailfrom.'</b>
					<br>
					<b>Mobile No: '.$mobileno.'</b>
					<br>
					<b>Subject: '.$subject.'</b>
					<br><br>
					<b>Message: '.$message.'</b>';

		if($mail->send()) {
				$_SESSION['mail-msg'] = '<div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success</strong>! Submit successful.
		</div>';
			echo '<script>window.location = "index.php#mail"</script>';
			} 
			else 
			{
				$_SESSION['mail-msg'] = '<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Failed</strong>
		</div>';
			echo '<script>window.location = "index.php#mail"</script>';
			}
	}
?>
