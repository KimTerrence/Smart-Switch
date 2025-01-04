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
</head>
<body class=" vh-100 " > 
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
    
    <section class="d-flex align-items-center justify-content-center flex-column w-100">
        <div class="container-fluid row  p-3 p-sm-5 gap-2 gap-sm-3 pt-3 m-0 d-flex flex-column flex-sm-row align-items-center justify-content-center" >
            <p class="w-100 text-center fs-2"> Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?> !</p>
            <?php 
            $sql = "SELECT * FROM switch "; //get data from database
            $switchResult = $conn->query($sql); // query
            while ($switch = $switchResult->fetch_assoc()) { //display data
                $_SESSION['ip'] == $switch['ip_address']; 
            ?>
            
            <div class="col-12 col-sm-3 rounded p-5 d-flex flex-column gap-2 justify-content-center align-items-center shadow" >
                <p class="text-center fw-bold"><?php echo $switch['name']; ?> </p>
            <!--Switch btn-->
                <form method="POST" action="../backend/switch_api.php" class="w-100 d-flex justify-content-between align-items-center gap-2" >
                    <input type="text" name="id" value="<?php echo $switch['id'] ?>" hidden>
                    <input type="text" name="switch" value="<?php echo $switch['switch'] ?>" hidden >
                    <input type="text" name="ip" value="<?php echo $switch['ip_address'] ?>" hidden >
                   
                    <label for="" class="fw-bold">Switch</label>
                    <div class=" d-flex gap-2 w-50">
                        <button onclick="controlLED('led_on')" type="submit" name="switchOn" value="On" class="btn w-50  
                        <?php if($switch['switch'] == "off"){
                            echo "btn-primary ";
                        }else{
                            echo " disabled";
                        }
                        ?>">On</button>
                        <button onclick="controlLED('led_off')" type="submit" name="switchOff" value="Off" class="btn w-50
                        <?php if($switch['switch'] == "on"){
                            echo "btn-danger ";
                        }else{
                            echo " disabled";
                        }
                        ?>">Off</button>
                    </div>
                </form>
            <!--Motion btn-->
                <form method="POST" action="../backend/switch_api.php" class="w-100 d-flex justify-content-between align-items-center gap-2" >
                    <input type="text" name="id" value="<?php echo $switch['id'] ?>" hidden>
                    <input type="text" name="motion" value="<?php echo $switch['motion'] ?>" hidden >
                    <input type="text" name="ip" value="<?php echo $switch['ip_address'] ?>" hidden >
                    <label for="" class="fw-bold">Motion Sensor</label>
                    <div class=" d-flex gap-2 w-50">
                    <button onclick="controlSensor('enable_sensor')" type="submit" name="motionOn" value="On" class="btn w-50 
                        <?php if($switch['motion'] == "off"){
                            echo "btn-primary ";
                        }else if($switch['motion'] == 'disabled'){
                            echo " disabled";
                        } else{
                            echo " disabled";
                        }
                        ?>">On</button>
                        <button onclick="controlSensor('disable_sensor')" type="submit" name="motionOff" value="Off" class="btn w-50  
                        <?php if($switch['motion'] == "on"){
                            echo "btn-danger ";
                        }else if($switch['motion'] == 'disabled'){
                            echo " disabled";
                        } else{
                            echo " disabled";
                        }
                        ?>">Off</button>
                    </div>
                </form>
            <!--Light btn-->
                <form method="POST" action="../backend/switch_api.php" class="w-100 d-flex justify-content-between align-items-center gap-2" >
                    <input type="text" name="id" value="<?php echo $switch['id'] ?>" hidden>
                    <input type="text" name="light" value="<?php echo $switch['light'] ?>" hidden >
                    <label for="" class="fw-bold">Light Sensor</label>
                    <div class=" d-flex gap-2 w-50">
                    <button type="submit" name="lightOn" value="On" class="btn w-50 
                        <?php if($switch['light'] == "off"){
                            echo "btn-primary ";
                        }else if($switch['light'] == "disabled"){  
                            echo " disabled";
                        }else {
                            echo " disabled";
                        }
                        ?>">On</button>
                        <button type="submit" name="lightOff" value="Off" class="btn w-50  
                        <?php if($switch['light'] == "on"){
                            echo "btn-danger ";
                        }else if($switch['light'] == "disabled"){  
                            echo " disabled";
                        }else {
                            echo " disabled";
                        }
                        ?>">Off</button>
                    </div>
                </form>
            </div>  
            
            <?php
                } 
            ?>
        </div>
    </section>
</body>
</html>