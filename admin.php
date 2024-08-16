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

$search_term = "";
if (isset($_GET['search'])) {
    $search_term = $conn->real_escape_string($_GET['search']);
}

$sql = "SELECT m.id AS member_id, m.name, m.email, m.phonenumber, m.services, p.pricing, p.amount, p.payment_date, p.validity
        FROM members m
        LEFT JOIN payments p ON m.id = p.id";

if (!empty($search_term)) {
    $sql .= " WHERE m.name LIKE '%$search_term%' OR m.email LIKE '%$search_term%' OR m.phonenumber LIKE '%$search_term%' OR m.services LIKE '%$search_term%'";
}

$sql .= " ORDER BY m.created_at DESC";
$result = $conn->query($sql);
if ($conn->error) {
    echo "Error: " . $conn->error; // Debugging SQL errors
}

if (isset($_POST['delete'])) {
    $id_to_delete = $_POST['delete'];
    $conn->query("DELETE FROM payments WHERE id = $id_to_delete");
    $conn->query("DELETE FROM members WHERE id = $id_to_delete");
   
    header("Location: admin.php"); // Refresh the page after deletion
    exit();
}

if (isset($_POST['extend_membership'])) {
    $id_to_extend = $_POST['extend_membership'];
    $extension_period = $_POST['extension_period'];

    // Get the current validity for the member
    $result = $conn->query("SELECT validity FROM payments WHERE id = $id_to_extend");
    $row = $result->fetch_assoc();
    $current_validity = $row['validity'];

    // Calculate new validity date
    $new_validity = $current_validity;
    switch ($extension_period) {
        case 'Monthly':
            $new_validity = date('Y-m-d H:i:s', strtotime($current_validity . ' +30 days'));
            break;
        case 'Quarterly':
            $new_validity = date('Y-m-d H:i:s', strtotime($current_validity . ' +90 days'));
            break;
        case 'Half-Yearly':
            $new_validity = date('Y-m-d H:i:s', strtotime($current_validity . ' +180 days'));
            break;
        case 'Yearly':
            $new_validity = date('Y-m-d H:i:s', strtotime($current_validity . ' +365 days'));
            break;
    }

    // Update validity in the database
    $conn->query("UPDATE payments SET validity = '$new_validity' WHERE id = $id_to_extend");

    header("Location: admin.php"); // Refresh the page after extending
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Zenith Forge Gym</title>
    <link rel="stylesheet" href="admin.css">
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
    
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-container button {
            padding: 10px 15px;
            background-color: #006064;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 5px;
        }
        .search-container button:hover {
            background-color: #004d40;
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
            overflow:hidden;
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
        .extend-form {
            display: inline-block;
        }
        .extend-select {
            padding: 5px;
            margin-right: 5px;
        }
        .logout-button {
            display: block;
            width: 10%;
            margin-top: 30px;
            padding: 5x 0;
            background-color: skyblue;
            color: white;
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s;
        }
        .logout-button:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <div class="search-container">
            <form action="admin.php" method="GET">
                <input type="text" name="search" placeholder="Search members by name, email, or service" value="<?php echo htmlspecialchars($search_term); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Services</th>
                    <th>Pricing</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>Validity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['member_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phonenumber']); ?></td>
                            <td><?php echo htmlspecialchars($row['services']); ?></td>
                            <td><?php echo htmlspecialchars($row['pricing']); ?></td>
                            <td><?php echo htmlspecialchars($row['amount'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($row['payment_date'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($row['validity'] ?? 'N/A'); ?></td>
                            <td>
                                <form action="admin.php" method="POST" style="display:inline;">
                                    <button type="submit" name="delete" value="<?php echo $row['member_id']; ?>">Delete</button>
                                </form>
                                <form class="extend-form" action="admin.php" method="POST" style="display:inline;">
                                    <select name="extension_period" class="extend-select" required>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quarterly">Quarterly</option>
                                        <option value="Half-Yearly">Half-Yearly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                    <button type="submit" name="extend_membership" value="<?php echo $row['member_id']; ?>">Extend</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align:center;">No members registered.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <form action="logout.php" method="POST">
    <button type="submit" class="logout-button">Logout</button>
</form>

    </div>
</body>
</html>

<?php
$conn->close();
?>
