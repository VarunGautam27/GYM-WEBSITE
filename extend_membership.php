<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $extension = $_POST['extension'];

    // Determine the validity period
    $validity_periods = [
        '1_month' => '+1 month',
        '3_months' => '+3 months',
        '6_months' => '+6 months',
        '1_year' => '+1 year'
    ];

    if (!array_key_exists($extension, $validity_periods)) {
        die("Invalid extension period.");
    }

    // Fetch current validity and pricing plan
    $current_validity_query = $conn->prepare("SELECT validity, pricing FROM members WHERE id = ?");
    $current_validity_query->bind_param('i', $user_id);
    $current_validity_query->execute();
    $current_validity_result = $current_validity_query->get_result();
    
    if ($current_validity_result->num_rows > 0) {
        $row = $current_validity_result->fetch_assoc();
        $current_validity = $row['validity'];
        $pricing = $row['pricing'];
        $new_validity = $current_validity ? date("Y-m-d", strtotime($validity_periods[$extension], strtotime($current_validity))) : date("Y-m-d", strtotime($validity_periods[$extension], strtotime(date("Y-m-d"))));
    } else {
        die("User not found.");
    }

    $current_validity_query->close();

    // Update the membership validity
    $stmt = $conn->prepare("UPDATE members SET validity = ? WHERE id = ?");
    $stmt->bind_param('si', $new_validity, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Membership extended successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
