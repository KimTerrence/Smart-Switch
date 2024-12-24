<?php
session_start();

include 'database_config.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header( "Location: login.php");
    exit;
}
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
    <title>Smart Switch</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css  "/>
    <script src="./bootstrap/js/bootstrap.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
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
               <a href="./logout.php" class="btn btn-danger text-white">Logout</a>
            </span>
            </div>  
        </div>
    </nav>

    <section class="px-2 bg-dark-subtle vh-100">
        <div class="bg-white shadow w-100 h-100 rounded shadow p-sm-5 p-0 d-flex flex-column align-items-center">
            <p class="w-100 text-center fs-1"> Welcome, <?php echo htmlspecialchars($row['firstname'] . " ". $row['lastname']); ?> !</p>
            <div class="h-75 w-75 bg-light-subtle rounded shadow d-flex flex-column align-items-center">
                <div class="d-flex align-items-center py-4 px-5  w-100">  
                    <div class="px-5 d-flex justify-content-between w-100 align-items-center">
                        <button class="btn btn-primary">Turn off all</button>
                        <p class="text-danger">December 29 10:20:1 AM</p>
                    </div>              
                </div>
                <div class="w-100  d-flex justify-content-center gap-5">
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Room 1</p>
                        <button class="btn btn-primary w-50">On</button>
                   </div>
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Room 2</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Room 3</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                </div>
                <div class="w-100 pt-5 d-flex justify-content-center gap-5">
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Kitchen</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Gues Room</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Balcony</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                </div>
                <div class="w-100 pt-5 d-flex justify-content-center gap-5">
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Terris</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Switch 1</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
                   <div class="bg-white shadow w-25  p-2 rounded d-flex align-items-center jusify-content-center flex-column">
                    <p>Switch 2</p>
                        <button class="btn btn-primary w-50">switch</button>
                   </div>
            </div>
        </div>
    </section>
</body>
</html>
