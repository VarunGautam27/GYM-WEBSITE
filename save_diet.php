<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the diet preference from the form
    $diet = $_POST['diet'];

    // Save the diet preference in the session
    $_SESSION['diet'] = $diet;

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the user's ID from the session (assuming you stored it during login)
    $user_id = $_SESSION['id'];

    // Prepare an SQL statement to update the diet preference in the database
    $stmt = $conn->prepare("UPDATE members SET diet_preference = ? WHERE id = ?");
    $stmt->bind_param('si', $diet, $user_id); // 'si' indicates a string and an integer

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the services page with a success message
        echo "<script>alert('Diet preference saved successfully!'); window.location.href='servicepage.php';</script>";
    } else {
        // Handle error
        echo "<script>alert('Error saving diet preference. Please try again.'); window.location.href='diet_management.php';</script>";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
