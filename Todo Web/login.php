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

// Query to check if the user exists
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // User found, return success response
    $response = array('success' => true);
    echo json_encode($response);
    session_start();
    $_SESSION['username'] = $username; // Assuming $username holds the logged-in username

} else {
    // User not found, return error response
    $response = array('success' => false);
    echo json_encode($response);
}

mysqli_close($conn);
?>
