<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

/ Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "todo"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $text = $data->text;
    $username = $data->username;

    $sql = "INSERT INTO todos (username, text) VALUES ('$username', '$text')";
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        $response = array('success' => false);
        echo json_encode($response);
    }
}

$conn->close();
?>
