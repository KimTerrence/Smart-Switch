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
                <h3 class="switchTitle"><?php echo $switch['name']; ?> </h3>
                <div class="switch">
                    <p>Switch</p>
                    <div class="btnCon">
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_on&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="<?php if($switch['status'] == 'restricted'){echo 'disabledBtn';}else if($switch['switch'] == 'off'){ echo 'onBtn';}else if($switch['switch'] == 'on'){echo 'disabledBtn';}?>">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_off&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="<?php if($switch['status'] == 'restricted'){echo 'disabledBtn';}else if($switch['switch'] == 'on'){ echo 'offBtn';}else if($switch['switch'] == 'off'){echo 'disabledBtn';}?>">OFF</a>
                    </div>
                </div>
                <div class="switch" >
                    <p>Motion</p>
                    <div class="btnCon">
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_sensor&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="<?php if($switch['status'] == 'restricted'){echo 'disabledBtn';}else if($switch['motion'] == 'off'){ echo 'onBtn';}else if($switch['motion'] == 'on'){echo 'disabledBtn';}elseif($switch['motion'] == 'disabled'){echo 'disabledBtn';}?>">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_sensor&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="<?php if($switch['status'] == 'restricted'){echo 'disabledBtn';}else if($switch['motion'] == 'on'){ echo 'offBtn';}else if($switch['motion'] == 'off'){echo 'disabledBtn';}elseif($switch['motion'] == 'disabled'){echo 'disabledBtn';}?>">OFF</a>
                    </div>
                </div>
                <div class="switch">
                    <p>Light</p>
                    <div class="btnCon">
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_light&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="<?php if($switch['status'] == 'restricted'){echo 'disabledBtn';}else if($switch['light'] == 'off'){ echo 'onBtn';}else if($switch['light'] == 'on'){echo 'disabledBtn';}elseif($switch['light'] == 'disabled'){echo 'disabledBtn';}?>">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_light&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="<?php if($switch['status'] == 'restricted'){echo 'disabledBtn';}else if($switch['light'] == 'on'){ echo 'offBtn';}else if($switch['light'] == 'off'){echo 'disabledBtn';}elseif($switch['light'] == 'disabled'){echo 'disabledBtn';}?>">OFF</a>
                    </div>
                </div>
                <?php 
                    $currentUser = $row['firstname'] . ' ' . $row['lastname'];
                if($switch['status'] == 'unrestrict'){ 
                ?>
                    <a href="../backend/restrict.php?id=<?php echo $switch['id'];?>&user=<?php echo $row['firstname'] . ' '. $row['lastname'];?>" class="restrictBtn">restrict</a>
                <?php }else if($switch['status'] == 'restricted' && $switch['user'] == $currentUser ){ ?>
                    <a href="../backend/unrestrict.php?id=<?php echo $switch['id'];?>" class="unrestrictBtn">Unrestrict</a>
                <?php }else{ ?>
                    <i class="restrictDesc"><?php echo "Restricted By: " . $switch['user']; ?></i>
                <?php } ?>
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