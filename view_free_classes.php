<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ADMIN_LOGIN.PHP"); // Redirect to login page if not logged in
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion of a free class entry
if (isset($_POST['delete_free_class'])) {
    $id_to_delete = $_POST['delete_free_class'];
    $conn->query("DELETE FROM free_class WHERE id = $id_to_delete");
    header("Location: view_free_classes.php"); // Refresh the page after deletion
    exit();
}

// Fetch all free class records
$sql = "SELECT id, name, phone, program, booking_date, created_at FROM free_class ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Free Classes - Zenith Forge Gym</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e0f7fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #006064;
            font-size: 28px;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        th {
            background-color: #006064;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #b2ebf2;
        }
        button {
            padding: 8px 15px;
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }
        button:hover {
            background-color: #b71c1c;
            transform: scale(1.05);
        }
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            padding: 10px 20px;
            background-color: #006064;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Free Class Registrations</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Program</th>
                    <th>Booking Date</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['program']); ?></td>
                            <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td>
                                <form action="view_free_classes.php" method="POST" style="display:inline;">
                                    <button type="submit" name="delete_free_class" value="<?php echo $row['id']; ?>">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No free class registrations found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="back-button">
            <a href="admin.php">Back to Admin Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
