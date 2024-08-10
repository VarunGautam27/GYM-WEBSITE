<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: servicepages.php");
    exit();
}

// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "gym_registration"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$user_id = $_SESSION['id'];

// Prepare and execute the deletion query
$sql = "DELETE FROM members WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Clear session and redirect to the login page
    session_unset();
    session_destroy();
    header("Location: login.php?message=Account deleted successfully.");
    exit();
} else {
    echo "Error deleting account: " . $conn->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
