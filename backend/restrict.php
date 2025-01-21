<?php
session_start();
include "database_config.php";

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id = $_GET['id'];
    $user = $_GET['user'];

$sql = "UPDATE switch SET status = 'restricted', user = '$user' where id = '$id'";


$result = $conn->query($sql);

if($result > 0){
    header('location: ../frontend/home.php');
}

}

?>