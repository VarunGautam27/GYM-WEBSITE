<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: servicepage.php");
    exit();
}

$user_id = $_SESSION['id'];

$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the deletion query
    $stmt = $pdo->prepare("DELETE FROM members WHERE id = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();


    session_unset();

    session_destroy();


    echo 
"<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Account Deleted</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: 	#E0FFFF;
                color: white;
                text-align: center;
                padding: 50px;
            }
            .container {
                background-color: #333;
                padding: 30px;
                border-radius: 10px;
                max-width: 500px;
                margin: auto;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            }
            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }
            p {
                font-size: 16px;
                margin-bottom: 20px;
            }
            a {
                color: #f44336;
                background-color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
            a:hover {
                background-color: #ffcccc;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Account Deleted</h1>
            <p>Your account has been successfully deleted. We're sorry to see you go.</p>
            <a href='signup.php'>Sign Up Again</a>
        </div>
    </body>
    </html>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
