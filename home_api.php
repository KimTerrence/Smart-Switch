<?php
session_start();

include 'database_config.php';

$user = $_SESSION['username'];
    

$sql = "SELECT * FROM user_info WHERE username='$user'";        
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  

    $data[] = $row;

} else {
    echo "No user found";
}

echo json_encode($data);

$conn->close();
?>
