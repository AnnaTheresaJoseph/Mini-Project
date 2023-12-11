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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        $updateSql = "UPDATE users SET NAME='$name', EMAIL='$email', PASSWORD='$password', PHONE_NUMBER='$phone' WHERE EMAIL='$email'";
        if ($conn->query($updateSql) === TRUE) {
            // Update successful, redirect to dashboard or any other page
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Update failed. Please try again.";
        }
    }
}
?>

<!-- Your HTML content -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
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
            <a href="dashboard.php">Home</a>



            <a href="logout.php" class="ml-auto">Logout</a> <!-- Logout button -->







        </div>
 
    <!-- Header content -->
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h1>Update Profile - Lost and Found System</h1>
            <div class="form-container">
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Full Name" value="<?php echo $user['NAME']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user['EMAIL']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $user['PASSWORD']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $user['PHONE_NUMBER']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer content -->
    <!-- Bootstrap JS and dependencies -->
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
