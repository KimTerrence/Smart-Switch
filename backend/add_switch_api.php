<?php 
    include "database_config.php";

    if($_SERVER["REQUEST_METHOD"] = "POST"){
        $name = $_POST['name'];
        $ip = $_POST['ip'];
        $light = $_POST['light'];
        $motion = $_POST['motion'];

        $sql= "INSERT INTO switch (name, ip_address, switch, motion, light) VALUE ( '$name', '$ip' , 'off', '$motion', '$light') ";

        if ($conn->query($sql) === TRUE) {
            //  header("Location: login.php");
            echo'<script>window.location = "../frontend/switch.php";</script>';
          }
    }
?>