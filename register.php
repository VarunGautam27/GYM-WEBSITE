<?php

$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phone'];
    $services = $_POST['services'];


    // Check if the user already exists
    $stmt = $conn->prepare("SELECT id FROM members WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo "<script>alert('A user with this email already exists.'); window.location.href='register.php';</script>";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO members (name, email, password, phonenumber, services, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssiss', $name, $email, $hashed_password, $phonenumber, $services,$created_at);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

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
   
    <style>
        #passwordCriteria {
    list-style-type: none;
    padding: 0;
    margin-top: 0px;
    font-size: 8px;
    color: #555;
        }


</style>
</head>
<body>
    <div class="container">
        <h1>Register at Zenith Forge Gym</h1>
        <form action="register.php" method="POST" class="register-form">
        <script src="password_strength.js" defer></script>
            <label for="username">Full Name:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <button type="button" id="togglePassword">Show</button>
                <ul id="passwordCriteria">
                <li>At least 8 characters</li>
                <li>At least one uppercase letter</li>
                <li>At least one number</li>
                <li>At least one symbol</li>
            </ul>
            </div>

            <label for="phone">Phone number:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="services">Choose services:</label>
            <select id="services" name="services" required>
                <option value="Physical Fitness">Physical Fitness</option>
                <option value="Fatloss">Fat Loss</option>
                <option value="Weight Lifting">Weight Lifting</option>
                <option value="Strength Training">Strength Training</option>
                <option value="Cardio">Cardio</option>
                <option value="Weight Gain">Weight Gain</option>
                
            </select>

            

            <div class="login-link">
                <span>Already have an account? <a href="login.php">Login</a></span>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
