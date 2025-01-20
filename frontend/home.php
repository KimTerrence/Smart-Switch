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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/homee.css">
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
<body> 
    <section class="home">
        <div class="homeCon" >
            <p class="title"> Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?> !</p>
            <?php 
            $sql = "SELECT * FROM switch ORDER BY id DESC"; //get data from database
            $switchResult = $conn->query($sql); // query
            while ($switch = $switchResult->fetch_assoc()) { //display data
                $_SESSION['ip'] == $switch['ip_address']; 
            ?>
            
            <div class="switchCon">
                <p class=""><?php echo $switch['name']; ?> </p>
                <div class="switch">
                    <p>Switch</p>
                    <div>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_on" class="onBtn">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_off" class="offBtn">OFF</a>
                    </div>
                </div>
                <div class="switch" >
                    <p>Motion</p>
                    <div>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_sensor" class="onBtn">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_sensor" class="offBtn">OFF</a>
                    </div>
                </div>
                <div class="switch">
                    <p>Light</p>
                    <div>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_light" class="onBtn">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_light" class="offBtn">OFF</a>
                    </div>
                </div>
                    <p id="sensor-status"></p>
            </div>
            <?php
                }
                if($switchResult < 0){echo "No Switch Available"; }
            ?>
        </div>
        <a href="../backend/logout.php" class="logoutBtn">Logout</a>
    </section>
</body>
</html>