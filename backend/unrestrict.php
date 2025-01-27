<?php
session_start();
include "database_config.php";

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id = $_GET['id'];

$sql = "UPDATE switch SET status = 'unrestrict', user = 'all' where id = '$id'";

$result = $conn->query($sql);

if($result > 0){
    if($_SESSION['status'] == 'Admin'){
        header('location: ../frontend/admin_home.php');
    }elseif($_SESSION['status'] == 'User'){
        header('location: ../frontend/home.php');
    }
}

}

?>