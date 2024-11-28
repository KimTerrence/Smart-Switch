<?php
header("Content-Type: application/json");

// Database credentials
$host = 'localhost';
$db = 'Appdev';
$user = 'root';
$password = '';

// Connect to the database
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Handle GET and POST requests
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM user_info";
    $result = $conn->query($sql);

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO user_info (firstname, lastname, username, password ) VALUES ('$firstname', '$lastname', '$username', '$pass')";
    if ($conn->query($sql)) {
        echo json_encode(["success" => "User added successfully"]);
    } else {
        echo json_encode(["error" => "Error adding user: " . $conn->error]);
    }
}

$conn->close();
?>
