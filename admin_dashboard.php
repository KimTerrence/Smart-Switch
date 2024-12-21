<?php 
session_start();
include 'database_config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <p>Admin Dashboard</p>
    <?php 
      $sql = "SELECT * FROM user_info where status = 'new' ";
      $result = $conn->query($sql);

        $row = $result->fetch_assoc();
    echo $row['firstname'] . ' ' . $row['lastname'];

        
    
    ?>
</body>
</html>