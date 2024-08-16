<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

  
    $stmt = $conn->prepare("SELECT id, password, services  FROM members WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      
        $stmt->bind_result($id, $hashed_password, $services);
        $stmt->fetch();

 
        if (password_verify($password, $hashed_password)) {

            $_SESSION['id'] = $id;
            $_SESSION['services'] = $services;
            $_SESSION['pricing'] = $pricing;

            header("Location: servicepage.php");
            exit();
        } else {
            $errorMsg = "Incorrect password!";
        }
    } else {
        $errorMsg = "No account found with that email!";
    }


    $stmt->close();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
  
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
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
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
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form class="form" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">LOGIN</button>
        </form>
        <?php if (!empty($errorMsg)): ?>
            <div class="error-message"><?php echo htmlspecialchars($errorMsg); ?></div>
        <?php endif; ?>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </div>
    </div>
</body>
</html>
