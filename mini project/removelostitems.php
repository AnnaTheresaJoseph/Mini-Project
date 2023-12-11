<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Assuming admin login credentials for demonstration
if ($_SESSION['email'] !== 'admin@gmail.com') {
    header("Location: login.php"); // Redirect non-admin users to the user dashboard
    exit();
}

require_once 'db.php';

$email = $_SESSION['email'];

// Process removal of lost items
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remove_lost_item'])) {
        $lost_item_id = $_POST['lost_item_id'];

        // Perform deletion of the selected lost item
        $delete_sql = "DELETE FROM lost_items WHERE item_id = $lost_item_id";
        if ($conn->query($delete_sql) === TRUE) {
            // Redirect to the same page after deletion or perform any other action
            header("Location: removelostitems.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Retrieve all lost items
$sql_lost_items = "SELECT * FROM lost_items";
$result_lost_items = $conn->query($sql_lost_items);

$lost_items = [];
if ($result_lost_items && $result_lost_items->num_rows > 0) {
    while ($row = $result_lost_items->fetch_assoc()) {
        $lost_items[] = $row;
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
<div class="header">
        <div class="container">
            <a href="admindashboard.php">Home</a>
            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->
        </div>
    </div>
    <div class="header">
        <!-- ... (your header content) ... -->
    </div>
    <!-- Main Content - Remove Lost Items -->
    <div class="main-content">
        <div class="container">
            <h1>Remove Lost Items - Lost and Found System</h1>
            <div class="row">
                <div class="col-md-12">
                    <h3>All Lost Items</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Lost Item ID</th>
                                <th>Lost User ID</th>

                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Lost Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lost_items as $item) : ?>
                                <tr>
                                    <td><?php echo $item['item_id']; ?></td>
                                    <td><?php echo $item['user_id']; ?></td>

                                    <td><?php echo $item['item_name']; ?></td>
                                    <td><?php echo $item['description']; ?></td>
                                    <td><?php echo $item['lost_date']; ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="lost_item_id" value="<?php echo $item['item_id']; ?>">
                                            <button type="submit" class="btn btn-danger" name="remove_lost_item">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
