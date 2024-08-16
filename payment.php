<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root"; // Use your database username
$password = ""; // Use your database password
$dbname = "gym_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$payment_method = '';
$account_number = '';
$amount = '';
$pricing = '';
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

    // Retrieve pricing plan
    if (isset($_POST['pricing'])) {
        $pricing = $_POST['pricing'];
    }

    // Calculate validity date based on the pricing plan
    $validity_date = '';
    switch ($pricing) {
        case 'Monthly':
            $validity_date = date('Y-m-d H:i:s', strtotime('+30 days'));
            break;
        case 'Quarterly':
            $validity_date = date('Y-m-d H:i:s', strtotime('+90 days'));
            break;
        case 'Half-Yearly':
            $validity_date = date('Y-m-d H:i:s', strtotime('+180 days'));
            break;
        case 'Yearly':
            $validity_date = date('Y-m-d H:i:s', strtotime('+365 days'));
            break;
        default:
            $validity_date = date('Y-m-d H:i:s', strtotime('+30 days'));
            break;
    }

    // Simulate payment success (replace this with actual payment processing logic)
    if (!empty($payment_method) && !empty($account_number) && !empty($amount)) {
        // Insert payment details into the database
        $stmt = $conn->prepare("INSERT INTO payments (pricing, amount, payment_date, validity) VALUES (?, ?, NOW(), ?)");
        $stmt->bind_param("sds", $pricing, $amount, $validity_date);

        if ($stmt->execute()) {
            $payment_success = true; // Payment record inserted successfully
        } else {
            // Handle error
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        /* Add your styles here */
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

            <label for="pricing">Select Pricing Plan:</label>
            <select name="pricing" class="input-field" required>
                <option value="Monthly">Monthly</option>
                <option value="Quarterly">Quarterly</option>
                <option value="Half-Yearly">Half-Yearly</option>
                <option value="Yearly">Yearly</option>
            </select>

            <label for="account_number">Enter Your Account Number/ID:</label>
            <input type="text" name="account_number" class="input-field" required>

            <label for="amount">Enter Amount:</label>
            <input type="number" name="amount" class="input-field" min="1" required>

            <label for="password">Enter Password:</label>
            <input type="password" name="password" class="input-field" required>

            <button type="submit" class="button">Proceed to Confirm Payment</button>
        </form>

        <?php if ($payment_success): ?>
            <p>Your payment of <strong><?php echo htmlspecialchars($amount); ?></strong> was successful!</p>
            <p>Your plan is: <strong><?php echo htmlspecialchars($pricing); ?></strong></p>
            <p>Validity Until: <strong><?php echo htmlspecialchars($validity_date); ?></strong></p>
        <?php else: ?>
            <?php if (!empty($account_number) || !empty($amount)): ?>
                <p>There was an error processing your payment. Please ensure all details are correct.</p>
            <?php endif; ?>
        <?php endif; ?>
        
        <button class="button" onclick="window.location.href='servicepage.php';">Go Back to Services</button>
    </div>
</body>
</html>
