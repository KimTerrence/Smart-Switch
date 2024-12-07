<?php
    
    include 'database_config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $cpw = $_POST['cpw'];

        if($cpw == $pass){

        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);  // Password encryption
        $sql = "INSERT INTO user_info (firstname, lastname, username, password) VALUES ( '$fname', '$lname', '$user', '$pass')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }else{
            $password = false;
         }
         echo $pass;
         echo $cpw;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css  "/>
    <script src="./bootstrap/js/bootstrap.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="d-flex align-items-center vh-100 w-100 justify-content-center bg-dark-subtle position-relative">
    <form  method="POST" class="d-flex flex-column align-items-center justify-content-center p-5 bg-white shadow rounded gap-4">
    <p class="fs-1 fw-bold">Register</p>
    <div class="d-flex gap-3">
            <div class="d-flex gap-3 flex-column"> 
                <input type="text" name="firstname" placeholder="Firstname" required class="form-control">
                <input type="text" name="lastname" placeholder="Lastname" required class="form-control">
                <input type="text" name="username" placeholder="Username" required class="form-control">
            </div>
            <div class="d-flex gap-3 flex-column"> 
                <input type="text" name="password" placeholder="Password"  class="form-control">
                <input type="text" name="cpw" placeholder="Confirm Password"  class="form-control">
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>
    </div>
        
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>

    <div class="position-fixed">
        <?php 
            if($password == false){
                echo'<script>
                        Swal.fire({
                        title: "The Internet?",
                        text: "That thing is still around?",
                        icon: "question"
                        });
                    </script>';
            }
        ?>
    </div>
</body>
</html>
