<?php
// Assuming you've already established a MySQL connection

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
