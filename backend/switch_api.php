<?php

session_start();

include 'database_config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $switch = $_POST['switch'];
    $id = $_POST['id'];
    $motion = $_POST['motion'];
    $light = $_POST['light'];
    $ip = $_POST['ip']; // target device ip address

    $url = "http://" . $ip; //device url

//-----switch
    if (isset($_POST['switchOn'])){
        $conn-> query("UPDATE switch set switch = 'on' WHERE id =  '$id' ");
        global $url;
        file_get_contents($url . "/led/on");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    } else if (isset($_POST['switchOff'])){
        $conn-> query("UPDATE switch set switch = 'off' WHERE id =  '$id' ");
        global $url;
        file_get_contents($url . "/led/off");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }else
//-----motion sensor
    if (isset($_POST['motionOn'])){
        $conn-> query("UPDATE switch set motion = 'on' WHERE id =  '$id' ");
        global $url;
        file_get_contents($url . "/motion/on");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    } else if (isset($_POST['motionOff'])){
        $conn-> query("UPDATE switch set motion = 'off' WHERE id =  '$id' ");
        global $url;
        file_get_contents($url . "/motion/off");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }else
//-----light sensor
    if (isset($_POST['lightOn'])){
        $conn-> query("UPDATE switch set light = 'on' WHERE id =  '$id' ");
        global $url;
        file_get_contents($url . "/light/on");
        echo'<script>window.location = "../frontend/home.php";</script>';
    exit;
    } else if (isset($_POST['lightOff'])){
        $conn-> query("UPDATE switch set light = 'off' WHERE id =  '$id' ");
        global $url;
        file_get_contents($url . "/ligth/off");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }

}


?>