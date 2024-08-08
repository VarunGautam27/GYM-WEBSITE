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
$email = $_POST[''];
$phone = $_POST['phone'];
$membership_type = $_POST['membership_type'];

// Prepare an SQL statement to insert the data into the database
$sql = "INSERT INTO members (name, email, phone, membership_type) VALUES ('$name', '$email', '$phone', '$membership_type')";

// Execute the SQL statement and check if the data was inserted successfully
if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
