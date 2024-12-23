<?php 
session_start();
include 'database_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css  "/>
    <script src="./bootstrap/js/bootstrap.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <p>Admin Dashboard</p>
    <table class="table table-striped table-hover w-50  "> 
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th >Status</th>
            <th colspan="3">Edit</th>
        </tr>
    <?php 
        $sql = "SELECT * FROM user_info "; //get data from database
        $result = $conn->query($sql); // query
        while ($row = $result->fetch_assoc()) { //display data
    ?>
    <tr>
        <td> <?php echo $row['firstname']; ?> </td>
        <td> <?php echo $row['lastname']; ?> </td>
        <td> <?php echo $row['status']; ?> </td>
        <td><img src="./assets/check.svg" alt="verify"></td>
        <td><img src="./assets/close.svg" alt="decline"></td>
        <td><img src="./assets/delete_b.svg" alt="delete"></td>
    </tr>

     <?php   
    }
    ?>
</table>
</body>
</html>