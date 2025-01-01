<?php 
session_start();
include '../backend/database_config.php';

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
    <title>Home</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css  "/>
    <script src="./bootstrap/js/bootstrap.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class=" vh-100" > 
    <nav class="navbar navbar-expand-lg bg-dark-subtle px-2">
        <div class="container-fluid bg-white px-lg-5 py-1 shadow rounded">
            <a class="navbar-brand" href="#">Smart Switch</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">         
            </ul>
            <span class="navbar-text d-flex justify-content-end p-2">
               <a href="../backend/logout.php" class="btn btn-danger text-white">Logout</a>
            </span>
            </div>  
        </div>
    </nav>
    
    <div class="h- w-100 row row-cols-4 gap-3 pt-3 m-0 d-flex align-items-center justify-content-center" >
        <p class="w-100 text-center fs-2"> Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?> !</p>
        <?php 
        $sql = "SELECT * FROM switch "; //get data from database
        $switchResult = $conn->query($sql); // query
        while ($switch = $switchResult->fetch_assoc()) { //display data
        ?>
        
        <div class=" col rounded p-5 d-flex flex-column gap-2 justify-content-center align-items-center shadow" >
            <p class="text-center fw-bold"><?php echo $switch['name']; ?> </p>
            <button class="btn btn-primary w-75">On/Off</button>
            <button class="btn btn-primary w-75">Motion Sensor</button>
        </div>
        
        <?php
            } 
        ?>
    </div>
</body>
</html>