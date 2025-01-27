<?php
 include 'database_config.php';

// Get the ID from the URL
$id = $_GET['id'];

// Delete the record
$sql = "DELETE FROM switch WHERE id = $id ";

if ($conn->query($sql) === TRUE) {
    echo'<script>window.location = "../frontend/switch.php";</script>';
    exit();
} else {
    echo "<script>alert('Error deleting record')</script>";
    echo'<script>window.location = "../frontend/switch.php";</script>';
}

// Close connection
$conn->close();


?>
