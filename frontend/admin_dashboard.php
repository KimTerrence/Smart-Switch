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
    <p class="text-center pt-5  w-100 fs-1">Admin Dashboard</p>
    <div class="d-flex w-100 px-5 gap-2 flex-column align-items-center">
        <div class="w-50 shadow m-5 p-2 rounded">
            <div class="d-flex justify-content-between">
                <div>
                    <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Switch</button>
                    <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addUser">Add User</button>
                    <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#viewUsers">View Users</button>
                </div>
                <a href="../backend/logout.php" class="btn btn-danger text-white m-2">Logout</a>
            </div>
        <!--Add Switch Modal-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Switch</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../backend/add_switch_api.php" method="POST" class="d-flex justify-content-center flex-column p-5 gap-2">
                                    <input type="text" name="name" placeholder="Name:" class="form-control" required>
                                    <input type="text" name="ip" placeholder="Ip Address:" class="form-control" required>
                                   <div class="d-flex gap-3 align-items-center justify-content-between">
                                        <label for="motion">Motion Sensor</label>
                                        <select name="motion" id="motion" class="form-select w-50">
                                            <option value="disabled">Disable</option>
                                            <option value="off">Enable</option>
                                        </select>
                                   </div>
                                   <div class="d-flex gap-3 align-items-center justify-content-between">
                                        <label for="light">Ligth Sensor</label>
                                        <select name="light" id="light" class="form-select w-50">
                                            <option value="disabled">Disable</option>
                                            <option value="off">Enable</option>
                                        </select>
                                   </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                                 <div class="modal-footer">
                                   
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

                <!--Add user Modal-->
                <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLbl" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewUsersLbl">Add User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            
                            <form action="../backend/register_api.php"  method="POST"  class="d-flex flex-column align-items-center justify-content-center p-5 bg-white rounded gap-4">
                                <div class="d-flex gap-3">
                                        <div class="d-flex gap-3 flex-column"> 
                                            <input type="text" name="firstname" placeholder="Firstname" required class="form-control">
                                            <input type="text" name="lastname" placeholder="Lastname" required class="form-control">
                                            <input type="text" name="username" placeholder="Username" required class="form-control">
                                        </div>
                                        <div class="d-flex gap-3 flex-column"> 
                                            <input type="text" name="password" placeholder="Password"  class="form-control">
                                            <input type="text" name="cpw" placeholder="Confirm Password"  class="form-control " required>
                                            <button type="submit" class="btn btn-primary w-100">Add</button>
                                        </div>
                                </div>   
                                </form>

                                 <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

        <!--User List Modal-->
                <div class="modal fade" id="viewUsers" tabindex="-1" aria-labelledby="viewUsersLbl" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="viewUsersLbl">View Users</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped table-hover w-100"> 
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th >Status</th>
                                    <th colspan="3">Edit</th>
                                </tr>
                                <?php 
                                    $sql = "SELECT * FROM user_info ORDER BY id DESC"; //get data from database
                                    $userResult = $conn->query($sql); // query
                                    while ($user = $userResult->fetch_assoc()) { //display data
                                 ?>
                                <tr>
                                    <td> <?php echo $user['firstname']; ?> </td>
                                    <td> <?php echo $user['lastname']; ?> </td>
                                    <td> <?php echo $user['status']; ?> </td>
                                    <td>
                                        <a href="../backend/block_user.php?id=<?php echo $user['id'] ; ?>&status=<?php echo $user['status'] ; ?>" class="btn btn-danger">
                                            Block
                                        </a>
                                    </td>
                                </tr>

                                <?php   
                                }
                                ?>
                            </table>
                                 <div class="modal-footer">
                                    
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

            <table class="table table-striped table-hover w-100">
                <tr>
                    <th>Name</th>
                    <th>IP</th>
                    <th>Switch</th>
                    <th>Motion</th>
                    <th>Light</th>
                    <th>Edit</th>   
                </tr>

                <?php 
                $sql = "SELECT * FROM switch ORDER BY id DESC"; //get data from database
                $switchResult = $conn->query($sql); // query
                while ($switch = $switchResult->fetch_assoc()) { //display data
                ?>

                <tr>
                    <td> <?php echo $switch['name']; ?> </td>
                    <td> <?php echo $switch['ip_address']; ?> </td>
                    <td> <?php echo $switch['switch']; ?> </td>
                    <td> <?php echo $switch['motion']; ?> </td>
                    <td> <?php echo $switch['light']; ?> </td>
                    <td>
                        <a href="../backend/delete_switch.php?id= <?php echo $switch['id'] ; ?> ">
                            <img src="./assets/delete_b.svg" alt="delete">
                        </a>
                    </td>
                </tr>
                
                <?php   
                }
                ?>

            </table>
        </div>
    </div>
</body>
</html>