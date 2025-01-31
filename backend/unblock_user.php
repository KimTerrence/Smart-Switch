<?php
 include 'database_config.php';

// Get the ID from the URL
$id = $_GET['id'];

echo $newStatus;
// Delete the record
$sql = "UPDATE user_info SET status = 'User'  WHERE id = $id ";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('User unblocked successfully')</script>";
    echo'<script>window.location = "../frontend/users.php";</script>';
    exit();
} else {
    echo "<script>alert('Error unblocking user')</script>";
    echo'<script>window.location = "../frontend/users.php";</script>';
    exit();
}

// Close connection
$conn->close();


?>
