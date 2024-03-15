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


$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
   
    $response = array('success' => true);
    echo json_encode($response);
    session_start();
    $_SESSION['username'] = $username; 

} else {
    
    $response = array('success' => false);
    echo json_encode($response);
}

mysqli_close($conn);
?>
