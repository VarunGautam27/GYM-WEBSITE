<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Code to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $program = $_POST['program'];
    $booking_date = $_POST['booking_date'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO free_class (name, phone, program, booking_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $phone, $program, $booking_date);

    // Execute the query
    if ($stmt->execute()) {
        echo "You have successfully booked a free class for the $program program!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Free Class</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: grey;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: skyblue;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 30px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, select, input {
            margin-bottom: 20px;
            font-size: 20px;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Your Free Class for One Week</h2>
        <p>Join our gym for a free trial class for a whole week. Select your preferred program and provide your details.</p>
        <form method="POST" action="">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Your Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="program">Select Your Program:</label>
            <select id="program" name="program" required>
                <option value="Physical Fitness">Physical Fitness</option>
                <option value="Fat Loss">Fat Loss</option>
                <option value="Weight Lifting">Weight Lifting</option>
                <option value="Strength Training">Strength Training</option>
                <option value="Cardio">Cardio</option>
                <option value="Weight Gain">Weight Gain</option>
            </select>

            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>

            <input type="submit" value="Book Free Class">
        </form>
         <!-- Success Message -->
         <?php if (!empty($success_message)) { ?>
            <div class="success-message">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>
    </div>
    </div>
</body>
</html>
