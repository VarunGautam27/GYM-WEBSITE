
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a statement to retrieve user details
    $stmt = $conn->prepare("SELECT id, password, services, pricing FROM members WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Bind result variables
        $stmt->bind_result($id, $hashed_password, $services, $pricing);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session and store user information
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['services'] = $services;
            $_SESSION['pricing'] = $pricing;

            // Redirect to the service details page with a success message
            echo "<script>alert('Sign in successful!'); window.location.href='services.php';</script>";
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password!'); window.location.href='login.html';</script>";
        }
    } else {
        // No user found with that email
        echo "<script>alert('No account found with that email!'); window.location.href='login.html';</script>";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form label {
            font-size: 16px;
            color: #333;
            text-align: left;
            display: block;
        }

        .form input,
        .form button {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .form button {
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form button:hover {
            background-color: #218838;
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .register-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #218838;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form class="form" action="" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">LOGIN</button>
    </form>
            
       
    </div>
</body>
</html>
