<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form when it's submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phone'];
    $services = $_POST['services'];
    $pricing = $_POST['pricing'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $created_at = date("Y-m-d H:i:s");

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO members (name, email, password, phonenumber, services, pricing, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind the parameters correctly using variables
    $stmt->bind_param('sssisss', $name, $email, $hashed_password, $phonenumber, $services, $pricing, $created_at);

    // Execute the SQL statement and check if the data was inserted successfully
    if ($stmt->execute()) {
        // Registration successful: Display a JavaScript alert
        echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Zenith Forge Gym</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h1>Register at Zenith Forge Gym</h1>
        <form action="register.php" method="POST" class="register-form">
            <label for="username">Full Name:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="phone">Phone number:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="services">Choose services:</label>
            <select id="services" name="services" required>
                <option value="physical">Physical Fitness</option>
                <option value="fatloss">Fat Loss</option>
                <option value="weight">Weight Lifting</option>
                <option value="strength">Strength Training</option>
                <option value="cardio">Cardio</option>
                <option value="weightgain">Weight Gain</option>
            </select>

            <label for="pricing">Choose pricing:</label>
            <select id="pricing" name="pricing" required>
                <option value="Quarterly">Quarterly</option>
                <option value="Monthly">Monthly</option>
                <option value="Half-yearly">Half-Yearly</option>
                <option value="Yearly">Yearly</option>
            </select>

            <div class="login-link">
                <span>Already have an account? <a href="login.html">Login</a></span>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
