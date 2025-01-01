<?php 
session_start();
include '../backend/database_config.php';
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
    <p class="text-center w-100 fs-1">Admin Dashboard</p>
    <div class="d-flex w-100 p-5 gap-5">
        <div class="w-50">
            <table class="table table-striped table-hover w-100"> 
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th >Status</th>
                    <th colspan="3">Edit</th>
                </tr>
            <?php 
                $sql = "SELECT * FROM user_info "; //get data from database
                $userResult = $conn->query($sql); // query
                while ($user = $userResult->fetch_assoc()) { //display data
            ?>
            <tr>
                <td> <?php echo $user['firstname']; ?> </td>
                <td> <?php echo $user['lastname']; ?> </td>
                <td> <?php echo $user['status']; ?> </td>
                <td><img src="./assets/check.svg" alt="verify"></td>
                <td><img src="./assets/close.svg" alt="decline"></td>
                <td><img src="./assets/delete_b.svg" alt="delete"></td>
            </tr>

            <?php   
            }
            ?>
            </table>
        </div>
        <div class="w-50">
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Switch</button>
                <a href="../backend/logout.php" class="btn btn-danger text-white m-2">Logout</a>
            </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Switch</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../backend/add_switch_api.php" method="POST" class="d-flex justify-content-center flex-column p-5 gap-2">
                                    <input type="text" name="name" placeholder="Name:" class="form-control">
                                    <input type="text" name="ip" placeholder="Ip Address:" class="form-control">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>


            <table class="table table-striped table-hover w-100">
                <tr>
                    <th>Switch</th>
                    <th>IP</th>
                    <th>Edit</th>   
                </tr>

                <?php 
                $sql = "SELECT * FROM switch "; //get data from database
                $switchResult = $conn->query($sql); // query
                while ($switch = $switchResult->fetch_assoc()) { //display data
                ?>

                <tr>
                    <td> <?php echo $switch['name']; ?> </td>
                    <td> <?php echo $switch['ip_address']; ?> </td>
                    <td><img src="./assets/delete_b.svg" alt="delete"></td>
                </tr>
                
                <?php   
                }
                ?>

            </table>
        </div>
    </div>
</body>
</html>