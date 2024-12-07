<?php
session_start();

include 'database_config.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header( "Location: login.php");
    exit;
}
    $user = $_SESSION['username'];
    

    $sql = "SELECT * FROM user_info WHERE username='$user'";        
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No user found";
    }
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Switch</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?>!</h1>
    <p>You are logged in.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
<?php
 