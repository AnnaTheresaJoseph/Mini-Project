<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE EMAIL = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    header("Location: login.php");
    exit();
}

// Add Lost Item Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_lost'])) {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $lost_date= $_POST['lost_date'];

    $sql_lost = "INSERT INTO lost_items (user_id, item_name, description, lost_date) VALUES ('{$user['ID']}', '$item_name', '$description','$lost_date')";

    if ($conn->query($sql_lost) === TRUE) {
        // Redirect to the same page or a confirmation page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error adding lost item: " . $conn->error;
    }
}
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
            background-image: url('123.jpg'); /* Replace with your background image URL */

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
    <!-- Header -->
    <!-- ... (same header content) ... -->
     <!-- Header -->
     <div class="header">
        <div class="container">
            <a href="dashboard.php">Home</a>



            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->







        </div>
 

    <!-- Main Content - User Dashboard Options -->
    <div class="main-content">
        <div class="container">
            <h1>Lost and Found System - Welcome, <?php echo $_SESSION['email']; ?></h1>
            <div class="row">
                <div class="col-md-6">
                    <h3>ADD Lost Items</h3>
                    <!-- Add Lost Item Form -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="item_name" placeholder="Item Name" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" placeholder="Description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="lost_date">Lost Date:</label>
                            <input type="date" class="form-control" name="lost_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_lost">Add Lost Item</button>
                    </form>
                    <!-- Option: View Lost Items -->
                </div>
                
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- ... (same footer content) ... -->

    <!-- Bootstrap JS and dependencies -->
    <!-- ... (same script tags) ... -->
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
