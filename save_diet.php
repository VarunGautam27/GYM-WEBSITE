
<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = "";  
$dbname = "gym_registration";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $diet = $_POST['diet'];

    $_SESSION['diet'] = $diet;

   
    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['id'];

    $stmt = $conn->prepare("UPDATE members SET diet_preference = ? WHERE id = ?");
    $stmt->bind_param('si', $diet, $user_id); // 'si' indicates a string and an integer

    if ($stmt->execute()) {

        echo "<script>alert('Diet preference saved successfully!'); window.location.href='servicepage.php';</script>";
    } else {
       
        echo "<script>alert('Error saving diet preference. Please try again.'); window.location.href='diet_management.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
