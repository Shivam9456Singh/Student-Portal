if (!$error) {
    $password = md5($password);
    $verification_code = bin2hex(random_bytes(32)); // generate a unique code

    // Add a field for verification_code in your student table
    $sql = "INSERT INTO student(name, Guardians_name, email, mobile, address, program, password, verification_code) 
            VALUES('$name', '$guardians_name', '$email', '$mobile','$address ', '$program', '$password', '$verification_code')";

    if (mysqli_query($conn, $sql)) {
       // Send verification email with unique link
       $verify_link = "https://yourwebsite.com/verify.php?code=$verification_code";
       $mail->Subject = 'Verify Your Email Address';
       $mail->Body = "Dear $name,<br><br>Thank you for registering! Please click the link below to verify your email:<br><a href='$verify_link'>$verify_link</a>";

       // ... rest of your email sending code ...
    }
}