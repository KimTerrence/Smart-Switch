<?php
session_start();
include "database_config.php";

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id = $_GET['id'];

$sql = "UPDATE switch SET status = 'unrestrict', user = 'all' where id = '$id'";

$result = $conn->query($sql);

if($result > 0){
    header('location: ../frontend/home.php');
}

}

?>