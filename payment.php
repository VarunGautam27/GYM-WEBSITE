<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$payment_method = '';
$account_number = '';
$amount = '';
$payment_success = false;

// Process the payment when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if payment method is set
    if (isset($_POST['payment_method'])) {
        $payment_method = $_POST['payment_method'];
    }
    
    // Retrieve account number or ID
    if (isset($_POST['account_number'])) {
        $account_number = $_POST['account_number'];
    }

    // Retrieve amount
    if (isset($_POST['amount'])) {
        $amount = $_POST['amount'];
    }

    // Simulate payment success (replace this with actual payment processing logic)
    if (!empty($payment_method) && !empty($account_number) && !empty($amount)) {
        $payment_success = true; // Assume success if all necessary fields are provided
    }
}

// Redirect back to the service page if no payment method was selected
if (empty($payment_method)) {
    header("Location: servicepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #26d3e9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #8cbcd6;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #00796b;
        }
        p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        .input-field {
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .button {
            padding: 10px;
            background-color: #00acc1;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #00838f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="hidden" name="payment_method" value="<?php echo htmlspecialchars($payment_method); ?>">
            <label for="account_number">Enter Your Account Number/ID:</label>
            <input type="text" name="account_number" class="input-field" required>
            
            <label for="amount">Enter Amount:</label>
            <input type="number" name="amount" class="input-field" min="1" required>
            
            <button type="submit" class="button">Proceed to Confirm Payment</button>
        </form>

        <?php if ($payment_success): ?>
            <p>Your payment of <strong><?php echo htmlspecialchars($amount); ?></strong> via <strong><?php echo htmlspecialchars($payment_method); ?></strong> was successful!</p>
        <?php else: ?>
            <?php if (!empty($account_number) || !empty($amount)): ?>
                <p>There was an error processing your payment. Please ensure all details are correct.</p>
            <?php endif; ?>
        <?php endif; ?>
        
        <button class="button" onclick="window.location.href='servicepage.php';">Go Back to Services</button>
    </div>
</body>
</html>
