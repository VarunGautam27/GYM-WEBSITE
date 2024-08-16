<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash the password
$admin_password = "admin123"; // Replace with the actual password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Insert the admin user
$sql = "INSERT INTO admin (username, password_hash) VALUES ('varunadmin', '$hashed_password')"; // Replace 'admin_username' with the actual username

if ($conn->query($sql) === TRUE) {
    echo "New admin user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
