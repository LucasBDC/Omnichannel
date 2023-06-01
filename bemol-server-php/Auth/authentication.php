<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Get the POST data from the request
$data = json_decode(file_get_contents("php://input"));

// Extract the registration details
$name = $data->name;
$email = $data->email;
$password = $data->password;
$cep = $data->cep;  

// Create a new MySQLi instance
$mysqli = new mysqli("localhost", "root", "", "omni");

// Check the connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Prepare the SQL statement
$stmt = $mysqli->prepare("INSERT INTO users (name_user, email_user, pass_user, cep_user) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $password, $cep);

// Execute the statement
if ($stmt->execute()) {
    // Registration successful
    $response = array("message" => "Registration successful");
    echo json_encode($response);
} else {
    // Registration failed
    $response = array("message" => "Registration failed");
    echo json_encode($response);
}

// Close the statement and the connection
$stmt->close();
$mysqli->close();
?>
