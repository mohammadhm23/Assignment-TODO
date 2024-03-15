<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$database = "todo"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$data = json_decode(file_get_contents("php://input"));


$username = mysqli_real_escape_string($conn, $data->username);
$password = mysqli_real_escape_string($conn, $data->password);
$email = mysqli_real_escape_string($conn, $data->email);


$query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

if (mysqli_query($conn, $query)) {
   
    $response = array('success' => true);
    echo json_encode($response);
} else {
   
    $response = array('success' => false);
    echo json_encode($response);
}

mysqli_close($conn);
?>
