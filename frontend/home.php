<?php 
session_start();
include '../backend/database_config.php';

/* Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header( "Location: login.php");
    exit;
} */
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
    <script>
        //function checkSensor() {
        //    fetch("control.php?action=check_sensor")
        //        .then(response => response.text())
        //        .then(data => {
        //            document.getElementById("sensor-status").innerText = data;
        //        });
        //}

        // Automatically check the sensor status every 5 seconds
        //setInterval(checkSensor, 1000);
    </script>
</head>
<body class=" vh-100 " > 
    <nav class="navbar navbar-expand-lg px-">
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
    
    <section class="d-flex align-items-center justify-content-center flex-column w-100">
        <div class="container-fluid row  p-3 p-sm-5 gap-2 gap-sm-3 pt-3 m-0 d-flex flex-column flex-sm-row align-items-center justify-content-center" >
            <p class="w-100 text-center fs-2"> Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?> !</p>
            <?php 
            $sql = "SELECT * FROM switch ORDER BY id DESC"; //get data from database
            $switchResult = $conn->query($sql); // query
            while ($switch = $switchResult->fetch_assoc()) { //display data
                $_SESSION['ip'] == $switch['ip_address']; 
            ?>
            
            <div class="w-100 col-12 col-sm-3 rounded p-5 d-flex flex-column gap-2 justify-content-center align-items-center shadow" >
                <p class="text-center fw-bold"><?php echo $switch['name']; ?> </p>
                
                    <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_on" class="btn btn-primary">Turn LED ON</a>
                    <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_off" class="btn btn-secondary">Turn LED OFF</a>
                    <h2>Sensor Control:</h2>
                    <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_sensor" class="btn btn-primary">Enable Sensor</a>
                    <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_sensor" class="btn btn-secondary">Disable Sensor</a>
                    <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_light" class="btn btn-primary">Enable light</a>
                    <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_light" class="btn btn-secondary">Disable light</a>
                    <p id="sensor-status"></p>
                </div>
            <?php
                } 
            ?>
        </div>
    </section>
</body>
</html>