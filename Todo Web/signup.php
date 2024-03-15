<?php
// Assuming you've already established a MySQL connection

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Default password is empty for XAMPP
$database = "todo"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve POST data
$data = json_decode(file_get_contents("php://input"));

// Sanitize input
$username = mysqli_real_escape_string($conn, $data->username);
$password = mysqli_real_escape_string($conn, $data->password);
$email = mysqli_real_escape_string($conn, $data->email);

// Query to insert user into the database
$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

if (mysqli_query($conn, $query)) {
    // User successfully added to the database
    $response = array('success' => true);
    echo json_encode($response);
} else {
    // Error occurred while adding user
    $response = array('success' => false);
    echo json_encode($response);
}

mysqli_close($conn);
?>
