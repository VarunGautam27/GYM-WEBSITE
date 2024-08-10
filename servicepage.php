<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
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
            background-color: #26d3e9; /* Light cyan background */
            background-image: url('servicebg.jpg'); /* Replace with the path to your background image */
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #8cbcd6; /* White background for the container */
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
            background-color: rgb(36, 156, 36); /* Even darker cyan */
        }
        .payment-container {
            background-color: #b3e5fc; /* Lighter cyan background for the payment box */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .payment-options {
            text-align: left;
            margin-bottom: 20px;
        }
        .payment-option {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .payment-option label {
            font-size: 16px;
            color: #397900; /* Dark cyan */
            margin-right: 5px; /* Reduced margin to bring logo closer */
            flex-grow: 1;
        }
        .payment-option img {
            width: 35px; /* Adjusted size to fit better with the label */
            height: auto;
        }
        .login_button {
            background-color: rgb(17, 202, 202);
            border: aqua;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            width: 100%;
            height: 5vh;
        }
        .login_button:hover {
            background-color: rgb(148, 225, 148); /* Even darker cyan */
        }
        .delete_button {
            background-color: rgb(255, 0, 0); /* Red color for delete button */
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            width: 100%;
            padding: 10px;
            color: white;
            font-size: 16px;
            margin-top: 20px;
        }
        .delete_button:hover {
            background-color: rgb(200, 0, 0); /* Darker red */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Subscription Details</h2>
        <p><strong>Selected Services:</strong> <?php echo htmlspecialchars($services); ?></p>
        <p><strong>Pricing Plan:</strong> <?php echo htmlspecialchars($pricing); ?></p>
        
        <div class="payment-container">
            <h2>Proceed to Payment</h2>
            <form action="payment.php" method="POST">
                <div class="payment-options">
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="esewa" required>
                            Pay via eSewa
                        </label>
                        <img src="esewa.jpg" alt="eSewa Logo">
                    </div>
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="mobile_banking" required>
                            Pay via Mobile Banking
                        </label>
                        <img src="mb.png" alt="Mobile Banking Logo">
                    </div>
                    <div class="payment-option">
                        <label>
                            <input type="radio" name="payment_method" value="khalti" required>
                            Pay via Khalti
                        </label>
                        <img src="khalti.png" alt="Khalti Logo">
                    </div>
                </div>
                <button type="submit" class="login_button">Pay Now</button>
            </form>
        </div>

        <div class="extra-services">
            <button onclick="window.location.href='diet_management.php';">Go to Diet Management</button>
        </div>

        <div class="delete-account">
            <form actionss="delete_account.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                <button type="submit" class="delete_button">Delete Subscrption</button>
            </form>
        </div>
    </div>
</body>
</html>
