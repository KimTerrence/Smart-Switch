<?php
session_start();

include 'database_config.php';

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

             // Redirect to dashboard
             echo'<script>window.location = "home.php";</script>';
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

