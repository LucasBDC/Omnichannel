<?php
$host = "localhost"; // Your MySQL host
$user = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$db = "omni"; // Your MySQL database name

// Establish a connection to MySQL
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the data from the HTTP POST request
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Perform the signup query
$sql = "INSERT INTO users (name_user, email_user, pass_user) VALUES ('$name', '$email', '$password')";
if ($conn->query($sql) === TRUE) {
    echo "Signup successful";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the MySQL connection
$conn->close();
?>
