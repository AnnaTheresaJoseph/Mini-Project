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
    <div class="header">
        <div class="container">
            <a href="dashboard.php">Home</a>


            <a href="updateprofile.php" class="ml-auto">Update Profile</a> <!-- Logout button -->

            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->
        </div>
 
    <!-- Main Content - User Dashboard Options -->
    <div class="main-content">
        <div class="container">
            <h1>Lost and Found System -- Welcome,<?php echo $_SESSION['email'];?></h1>
            

            <div class="row">
                <div class="col-md-6">
                    <h3>Lost Items</h3>
                    <!-- Option: Add Lost Item Details -->
                    <a href="addlostitem.php" class="btn btn-primary">Add Lost Item</a>
                    <!-- Option: View Lost Items -->
                    <a href="viewlostitem.php" class="btn btn-secondary">View Lost Items</a>
                    <a href="removelostitem.php" class="btn btn-danger">Remove Lost Items</a>

                </div>
                <div class="col-md-6">
                    <h3>Found Items</h3>
                    <!-- Option: Add Found Item Details -->
                    <a href="addfounditem.php" class="btn btn-primary">Add Found Item</a>
                    <!-- Option: View Found Items -->
                    <a href="viewfounditem.php" class="btn btn-secondary">View Found Items</a>

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
