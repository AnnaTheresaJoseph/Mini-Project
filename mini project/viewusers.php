<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Assuming admin login credentials for demonstration
if ($_SESSION['email'] !== 'admin@gmail.com') {
    header("Location: dashboard.php"); // Redirect non-admin users to the user dashboard
    exit();
}

require_once 'db.php';

$email = $_SESSION['email'];

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
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
     <!-- Header -->
     <div class="header">
        <div class="container">
            <a href="admindashboard.php">Home</a>
            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->
        </div>
 
    <!-- Main Content - View Users -->
    <div class="main-content">
        <div class="container">
            <h1>View Users - Lost and Found System</h1>
            <div class="row">
                <div class="col-md-12">
                    <h3>All Users</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user['ID']; ?></td>
                                    <td><?php echo $user['NAME']; ?></td>
                                    <td><?php echo $user['EMAIL']; ?></td>
                                    <td><?php echo $user['PHONE_NUMBER']; ?></td>
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
