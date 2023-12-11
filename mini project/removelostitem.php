<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

require_once 'db.php';

$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE EMAIL = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Handle if user data is not found
    // For example, redirect to login page
    header("Location: login.php");
    exit();
}

// Retrieve lost items added by the current user
$sql_lost_items = "SELECT * FROM lost_items WHERE user_id = '{$user['ID']}'";
$lost_items_result = $conn->query($sql_lost_items);
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Lost and Found System</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Customize your styles here */
        /* Header styles */
        .header {
            background-color: #2C3E50;
            color: #fff;
            padding: 15px 0;
            position: relative;
            z-index: 1;
        }

        .header a {
            color: #fff;
            margin: 0 20px;
            font-size: 18px;
        }

        .header a:hover {
            text-decoration: none;
            color: #FFA500;
        }

        /* Main Content styles */
        .main-content {
            background-image: url('28516.jpg'); /* Replace with your background image URL */

            background-color: #f2f2f2;
            min-height: 600px;
            padding: 100px 0;
            text-align: center;
        }

        /* Footer styles */
        .footer {
            background-color: #2C3E50;
            color: #fff;
            padding: 20px 0;
            position: relative;
            z-index: 1;
        }

        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Include your header content here -->
    <div class="header">
        <div class="container">
            <a href="dashboard.php">Home</a>



            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->
        </div>
    <!-- Main Content - Remove Lost Items -->
    <div class="main-content">
        <div class="container">
            <h1>Lost and Found System - Welcome, <?php echo $_SESSION['email']; ?></h1>
            <div class="row">
                <div class="col-md-6">
                    <h3>Remove Lost Items</h3>
                    <?php
                    if ($lost_items_result && $lost_items_result->num_rows > 0) {
                        while ($row = $lost_items_result->fetch_assoc()) {
                            echo "<div class='card mb-7'>";
                            echo "<div class='card-body' style='color: black; '>"; // Set text color to black
                            echo "<h5 class='card-title'>Item Name: " . $row['item_name'] . "</h5>";
                            echo "<p class='card-text'>Description: " . $row['description'] . "</p>";
                            echo "<form action='' method='POST'>";
                            echo "<input type='hidden' name='item_id' value='" . $row['item_id'] . "'>";
                            echo "<button type='submit' class='btn btn-danger' name='remove_lost'>Remove</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                        }
                        // Remove Lost Item Logic
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_lost'])) {
                            $item_id = $_POST['item_id'];
                            $sql_remove = "DELETE FROM lost_items WHERE item_id = '$item_id' AND user_id = '{$user['ID']}'";

                            if ($conn->query($sql_remove) === TRUE) {
                                header("Location: removelostitem.php");
                                exit();
                            } else {
                                echo "Error removing item: " . $conn->error;
                            }
                        }
                    } else {
                        echo "<p>No lost items found.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your footer content here -->

    <!-- Include your script tags here -->
    <div class="footer">
        <div class="container text-center">
            <p>&copy; <?php echo date("Y"); ?> Lost and Found System</p>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
