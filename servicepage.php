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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #004d4d, #009999);
            padding: 20px;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 30px;
            font-size: 28px;
            color: #ffcc00;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #ccc;
        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .form button {
            padding: 15px;
            font-size: 16px;
            background-color: #ffcc00;
            color: #333;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .form button:hover {
            background-color: #e6b800;
        }
        .extra-services {
            margin-top: 30px;
        }
        .extra-services button {
            margin-top: 10px;
            background-color: #006600;
        }
        .extra-services button:hover {
            background-color: #004d00;
        }
        .payment-options label {
            display: block;
            font-size: 18px;
            margin-bottom: 15px;
            color: #ffcc00;
        }
        .payment-options input[type="radio"] {
            margin-right: 10px;
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
