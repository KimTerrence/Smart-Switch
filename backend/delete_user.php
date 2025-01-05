<?php
 include 'database_config.php';

// Get the ID from the URL
$id = $_GET['id'];

// Delete the record
$sql = "DELETE FROM user_info WHERE id = $id ";

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
