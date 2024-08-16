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
        $success_message = "You have successfully booked a free class for the $program program!";
    } else {
        $success_message = "Error: " . $stmt->error;
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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #666;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="date"]:focus, select:focus {
            border-color: #007BFF;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Success Message */
        .success-message {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            color: green;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            label, input, select {
                font-size: 16px;
            }

            input[type="submit"] {
                font-size: 16px;
            }
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
        <?php if (!empty($success_message)) { ?>
            <script>
                alert("<?php echo $success_message; ?>");
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 1000); // Redirect after 1 second
            </script>
        <?php } ?>
    </div>
</body>
</html>
