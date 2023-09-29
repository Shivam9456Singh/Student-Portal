<?php
require_once "./includes/dbh.config.php"; // Your database connection file
$conn = Database::connect();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['name'])) {
    die("Image name not provided.");
}

$name = $_GET['name'];

$sql = "SELECT transaction_image, mime_type FROM student WHERE name = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (empty($row['transaction_image'])) {
        die("Image data is empty for the given name.");
    }

    // Set the Content-Type header based on the MIME type from the database
    header("Content-type: " . $row['mime_type']);

    // Output the image data
    echo $row['transaction_image'];
} else {
    die("No data found for the name: " . $name);
}

$conn->close();
?>
