<?php
require_once "./includes/dbh.config.php";
$conn = Database::connect();

if (isset($_GET['code'])) {
    $code = mysqli_real_escape_string($conn, $_GET['code']);
    
    // Check if the code exists in the database
    $query = "SELECT * FROM student WHERE verification_code = '$code'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // Update email_verified to true
        $updateQuery = "UPDATE student SET email_verified = 1 WHERE verification_code = '$code'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "Email verified successfully!";
        } else {
            echo "Error verifying email.";
        }
    } else {
        echo "Invalid verification code.";
    }
}
?>
