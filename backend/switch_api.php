<?php

session_start();

include 'database_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $switch = $_POST['switch'];
    $id = $_POST['id'];

    if (isset($_POST['on'])){
        $conn-> query("UPDATE switch set switch = 'on' WHERE id =  '$id' ");
        
        echo'<script>window.location = "../frontend/home.php";</script>';
    exit;
    } 
    if (isset($_POST['off'])){
        $conn-> query("UPDATE switch set switch = 'off' WHERE id =  '$id' ");
        echo'<script>window.location = "../frontend/home.php";</script>';
        exit;
    }
}
?>