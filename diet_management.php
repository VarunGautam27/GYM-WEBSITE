<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// Diet options with descriptions
$diet_options = [
    "Keto Diet" => "A low-carb, high-fat diet that helps your body burn fat more effectively.",
    "Vegetarian Diet" => "A diet that excludes meat and focuses on plant-based foods.",
    "Vegan Diet" => "A strict vegetarian diet that eliminates all animal products.",
    "Mediterranean Diet" => "A heart-healthy diet based on the traditional foods of the Mediterranean region.",
    "Paleo Diet" => "A diet that mimics the eating habits of our Paleolithic ancestors, focusing on whole foods.",
    "Low-Carb Diet" => "A diet that restricts carbohydrates to promote weight loss and improve health."
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: gym-diet-cover-1.jpg; /* Replace with the path to your background image */
            background-size: cover;
            background-position: center;
            padding: 20px;
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #00796b; /* Dark cyan */
        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .form button {
            font-size: 16px;
    background-color: #28a745;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
        }
        .form button:hover {
            background-color:rgb(34, 216, 216);
        }
        .diet-options {
            text-align: left;
            margin-bottom: 20px;
        }
        .diet-options label {
            display: block;
            font-size: 14px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .diet-description {
            font-size: 12px;
            color: #555;
            margin-bottom: 20px;

        }
        button{
            background
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Diet Management System</h2>
        <form action="save_diet.php" method="POST">
            <div class="diet-options">
                <?php foreach ($diet_options as $option => $description): ?>
                    <label>
                        <input type="radio" name="diet" value="<?php echo htmlspecialchars($option); ?>" required>
                        <?php echo htmlspecialchars($option); ?>
                    </label>
                    <p class="diet-description"><?php echo htmlspecialchars($description); ?></p>
                <?php endforeach; ?>
            </div>
            <button type="submit">Save Diet Preference</button>
        </form>
    </div>
</body>
</html>
