<?php

session_start();

include 'database_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $switch = $_POST['switch'];
    $id = $_POST['id'];
    $motion = $_POST['motion'];
    $light = $_POST['light'];

    if (isset($_POST['switchOn'])){
        $conn-> query("UPDATE switch set switch = 'on' WHERE id =  '$id' ");
        
        echo'<script>window.location = "../frontend/home.php";</script>';
    exit;
    } else if (isset($_POST['switchOff'])){
        $conn-> query("UPDATE switch set switch = 'off' WHERE id =  '$id' ");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }

    if (isset($_POST['motionOn'])){
        $conn-> query("UPDATE switch set motion = 'on' WHERE id =  '$id' ");
        
        echo'<script>window.location = "../frontend/home.php";</script>';
    exit;
    } else if (isset($_POST['motionOff'])){
        $conn-> query("UPDATE switch set motion = 'off' WHERE id =  '$id' ");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }

    if (isset($_POST['lightOn'])){
        $conn-> query("UPDATE switch set light = 'on' WHERE id =  '$id' ");
        
        echo'<script>window.location = "../frontend/home.php";</script>';
    exit;
    } else if (isset($_POST['lightOff'])){
        $conn-> query("UPDATE switch set light = 'off' WHERE id =  '$id' ");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }
}
?>