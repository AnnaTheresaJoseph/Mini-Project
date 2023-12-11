<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_lost'])) {
    $selected_lost_items = $_POST['lost_items'];

    if (!empty($selected_lost_items)) {
        require_once 'db.php';

        foreach ($selected_lost_items as $lost_item_id) {
            $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
            $sql_delete = "DELETE FROM lost_items WHERE item_id = '$lost_item_id' AND user_id = '$user_id'";
            $conn->query($sql_delete);
        }
    }

    header("Location: dashboard.php");
    exit();
} else {
    header("Location: removelostitem.php");
    exit();
}
?>
