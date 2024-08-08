<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// Retrieve user information from the session
$services = $_SESSION['services'];
$pricing = $_SESSION['pricing'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Subscription Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .form button {
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }
        .form button:hover {
            background-color: #218838;
        }
        .extra-services {
            margin-top: 30px;
        }
        .extra-services button {
            margin-top: 10px;
            background-color: #007bff;
        }
        .extra-services button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Subscription Details</h2>
        <p><strong>Selected Services:</strong> <?php echo htmlspecialchars($services); ?></p>
        <p><strong>Pricing Plan:</strong> <?php echo htmlspecialchars($pricing); ?></p>
        
        <h2>Proceed to Payment</h2>
        <form action="payment.php" method="POST">
            <div class="payment-options">
                <label>
                    <input type="radio" name="payment_method" value="esewa" required>
                    Pay via eSewa
                </label>
                <label>
                    <input type="radio" name="payment_method" value="mobile_banking" required>
                    Pay via Mobile Banking
                </label>
            </div>
            <button type="submit">Pay Now</button>
        </form>

        <div class="extra-services">
            <h2>Manage Your Diet</h2>
            <button onclick="window.location.href='diet_management.php';">Go to Diet Management</button>
        </div>
    </div>
</body>
</html>
