<?php 
    include "database_config.php";

    if($_SERVER["REQUEST_METHOD"] = "POST"){
        $name = $_POST['name'];
        $ip = $_POST['ip'];

        $sql= "INSERT INTO switch (name, ip_address) VALUE ( '$name', '$ip') ";

        if ($conn->query($sql) === TRUE) {
            //  header("Location: login.php");
            echo'<script>window.location = "../frontend/admin_dashboard.php";</script>';
          }
    }
?>