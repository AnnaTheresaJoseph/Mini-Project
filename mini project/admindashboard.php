<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Assuming admin login credentials for demonstration
if ($_SESSION['email'] !== 'admin@gmail.com') {
    header("Location: index.php"); // Redirect non-admin users to the user dashboard
    exit();
}

require_once 'db.php';


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
    <!-- ... (your header content) ... -->
        <div class="header">
        <div class="container">
            <a href="admindashboard.php">Home</a>
            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->
        </div>
    </div>
    <!-- Main Content - Admin Dashboard Options -->
    <div class="main-content">
        <div class="container">
            <h1>Admin Dashboard - Lost and Found System</h1>
            <div class="row">
                <div class="col-md-6">
                    <h3>User Management</h3>
                    <!-- Option: View Users -->
                    <a href="viewusers.php" class="btn btn-secondary">View Users</a>
                    <!-- Option: Remove Users -->
                    <a href="removeusers.php" class="btn btn-danger">Remove Users</a>
                </div>
                <div class="col-md-6">
                    <h3>Lost and Found Items</h3>
                    <!-- Option: View Lost Items -->
                    <a href="viewlostitems.php" class="btn btn-secondary">View Lost Items</a>
                    <!-- Option: Remove Lost Items -->
                    <a href="removelostitems.php" class="btn btn-danger">Remove Lost Items</a>
                    <!-- Option: Remove Found Items -->
                    <a href="removefounditems.php" class="btn btn-danger">View & Remove Found Items</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
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
