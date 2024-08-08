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
            background-color: #e0f7fa; /* Light cyan background */
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff; /* White background for the container */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #00796b; /* Dark cyan */
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        .form button {
            padding: 10px;
            font-size: 16px;
            background-color: #00acc1; /* Medium cyan */
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            width: 100%;
        }
        .form button:hover {
            background-color: #00838f; /* Darker cyan */
        }
        .extra-services {
            margin-top: 20px;
        }
        .extra-services button {
            padding: 10px;
            background-color: #004d40; /* Dark cyan */
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            width: 100%;
        }
        .extra-services button:hover {
            background-color: #00251a; /* Even darker cyan */
        }
        .payment-options label {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
            color: #00796b; /* Dark cyan */
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
                <label>
                    <input type="radio" name="payment_method" value="khalti" required>
                    Pay via khalti
                </label>
            </div>
            <button type="submit">Pay Now</button>
        </form>

        <div class="extra-services">
            <button onclick="window.location.href='diet_management.php';">Go to Diet Management</button>
        </div>
    </div>
</body>
</html>
