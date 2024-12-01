<?php
session_start();

$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "Appdev";



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM user_info WHERE username='$user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;  // Store user info in session
            $_SESSION['loggedin'] = true;
            echo "Login successful";
         

             // Redirect to dashboard
             header("Location: home.php");
             exit;

         } else {
             // Password mismatch
             header("Location: login.php?error=Invalid credentials");
             exit;
         }
    } else {
        header("Location: login.php?error=No user found");
        exit;
    }
}
$conn->close();

?>

