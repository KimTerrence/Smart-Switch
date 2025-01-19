<?php
 include 'database_config.php';

// Get the ID from the URL
$id = $_GET['id'];
$status = $_GET['status'];

$newStatus = 'blocked_' . $status;

echo $newStatus;
// Delete the record
$sql = "UPDATE user_info SET status = '$newStatus'   WHERE id = $id ";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully')</script>";
    echo'<script>window.location = "../frontend/admin_dashboard.php";</script>';
    exit();
} else {
    echo "<script>alert('Error deleting record')</script>";
    echo'<script>window.location = "../frontend/admin_dashboard.php";</script>';
}

// Close connection
$conn->close();


?>
