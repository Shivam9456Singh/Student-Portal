<?php
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'users';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Perform a query to retrieve data from the table
// $query = "SELECT * FROM user_table"; // Replace 'user_table' with the actual name of your table

// $result = $connection->query($query);

// // Check if the query was successful
// if ($result) {
//     // Process the retrieved data
//     while ($row = $result->fetch_assoc()) {
//         // Access individual data fields like $row['column_name']
//         $firstName = $row['first_name'];
//         $lastName = $row['last_name'];
//         $address = $row['address'];
//         $city = $row['city'];
//         // ... and so on
//         // You can perform any other operation on the retrieved data here
//     }
// } else {
//     echo "Error executing query: " . $connection->error;
// }


?>
