<?php
session_start();

include 'database_config.php';

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    

    $sql = "SELECT * FROM user_info WHERE username='$user'";        
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row); // Send user info as JSON
        echo "hi" . $row['firstname'] . $row['lastname'];
    } else {
        echo "No user found";
    }
} else {
    echo "User not logged in";
}

$conn->close();
?>
