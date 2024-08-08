<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";


$conn = new mysqli($servername, $username, $password, $dbname);

n
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['username'];
$email = $_POST['eail'];
$password = $_POST['password'];
$phonenumber = $_POST['phone'];
$services = $_POST['services'];
$pricing = $_POST['pricing'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO members (name, email,passord, phonenumber,services,pricing ) VALUES ('$name', '$email', '$hashed_password', '$phonenumber', '$services','$pricing')";

// Execute the SQL statement and check if the data was inserted successfully
if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
