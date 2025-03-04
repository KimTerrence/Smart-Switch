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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/homee.css">
    <link rel="stylesheet" href="../frontend/bootstrap/css/bootstrap.css">
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
    <div id="top"></div>
    <section class="d-flex  align-items-center justify-content-center flex-column min-vh-100">
        <div class="home container-fluid row  p-3 gap-5 pt-3 m-0 d-flex flex-column flex-sm-row align-items-center justify-content-center" >
            <!--<p class="title"> Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?> !</p>-->
            <?php 
            $sql = "SELECT * FROM switch ORDER BY id DESC"; //get data from database
            $switchResult = $conn->query($sql); // query
            if($switchResult->num_rows <= 0){
                ?><p class="text-light text-center">No Switch Available</p>
                
                <?php
            }
            while ($switch = $switchResult->fetch_assoc()) { //display data
                $_SESSION['ip'] == $switch['ip_address']; 
                $currentUser = $row['firstname'] . ' ' . $row['lastname'];
            ?>
            
            <div class="switchCon  col-12 col-sm-3 rounded p-5 d-flex flex-column gap-2 justify-content-center align-items-center text-white">
                <h3 class="switchTitle"><?php echo $switch['name']; ?> </h3>
                <div class="switch d-flex w-75 justify-content-between">
                    <p class="fs-5 p-0 m-0 w-50">Switch</p>
                    <div class="btnCon w-50 d-flex gap-1 justify-content-between">
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_on&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="w-50 fs-5 <?php if($switch['status'] == 'restricted'){echo 'btn disabled';}else if($switch['switch'] == 'off'){ echo 'btn btn-primary';}else if($switch['switch'] == 'on'){echo 'btn disabled';}?>">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=led_off&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="w-50 fs-5 <?php if($switch['status'] == 'restricted'){echo 'btn disabled';}else if($switch['switch'] == 'on'){ echo 'btn btn-danger';}else if($switch['switch'] == 'off'){echo 'btn disabled';}?>">OFF</a>
                    </div>
                </div>
                <div class="switch d-flex w-75 justify-content-between" >
                    <p class="fs-5 p-0 m-0">Motion</p>
                    <div class="btnCon w-50 d-flex gap-1 justify-content-between">
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_sensor&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="w-50 fs-5 <?php if($switch['status'] == 'restricted'){echo 'btn disabled';}else if($switch['motion'] == 'off'){ echo 'btn btn-primary';}else if($switch['motion'] == 'on'){echo 'btn disabled';}elseif($switch['motion'] == 'disabled'){echo 'btn disabled';}?>">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_sensor&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="w-50 fs-5 <?php if($switch['status'] == 'restricted'){echo 'btn disabled';}else if($switch['motion'] == 'on'){ echo 'btn btn-danger';}else if($switch['motion'] == 'off'){echo 'btn disabled';}elseif($switch['motion'] == 'disabled'){echo 'btn disabled';}?>">OFF</a>
                    </div>
                </div>
                <div class="switch switch d-flex w-75 justify-content-between">
                    <p class="fs-5 p-0 m-0">Light</p>
                    <div class="btnCon w-50 d-flex gap-1 justify-content-between">
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=enable_light&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="w-50 fs-5 <?php if($switch['status'] == 'restricted'){echo 'btn disabled';}else if($switch['light'] == 'off'){ echo 'btn btn-primary';}else if($switch['light'] == 'on'){echo 'btn disabled';}elseif($switch['light'] == 'disabled'){echo 'btn disabled';}?>">ON</a>
                        <a href="control.php?ip=<?php echo $switch['ip_address'];?>&action=disable_light&name=<?php echo $switch['name'];?>&currentUsr=<?php echo $currentUser;?>" class="w-50 fs-5 <?php if($switch['status'] == 'restricted'){echo 'btn disabled';}else if($switch['light'] == 'on'){ echo 'btn btn-danger';}else if($switch['light'] == 'off'){echo 'btn disabled';}elseif($switch['light'] == 'disabled'){echo 'btn disabled';}?>">OFF</a>
                    </div>
                </div>
                <?php 
                if($switch['status'] == 'unrestrict'){ 
                ?>
                    <a href="../backend/restrict.php?id=<?php echo $switch['id'];?>&user=<?php echo $row['firstname'] . ' '. $row['lastname'];?>" class="btn btn-danger align-self-end mx-5 fs-5">restrict</a>
                <?php }else if($switch['status'] == 'restricted' && $switch['user'] == $currentUser ){ ?>
                    <a href="../backend/unrestrict.php?id=<?php echo $switch['id'];?>" class="btn btn-primary align-self-end mx-5 fs-5">Unrestrict</a>
                <?php }else{ ?>
                    <i class="text-danger fs-6"><?php echo "Restricted By: " . $switch['user']; ?></i>
                <?php } ?>
                </div>
                <?php
                }
                    if($switchResult < 0){echo "No Switch Available"; }
                ?>
        </div>
        <a href="../backend/logout.php" class="position-fixed btn btn-danger top-0 end-0 m-5 fs-5 px-5 py-3">Logout</a>
        <a href="#top" class="btn btn-success position-fixed bottom-0 end-0 m-5 py-3 px-4 rounded-circle">^</a>
    </section>
</body>
</html>