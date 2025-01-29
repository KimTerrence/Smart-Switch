<?php 
    session_start();
    include '../backend/database_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | User</title>
    <link rel="stylesheet" href="./styles/user.css">
    <link rel="stylesheet" href="../frontend/bootstrap/css/bootstrap.css">
</head>
<body>
    <nav>
        <img src="./frontend/assets/bulb.png" alt="">
        <div class="navCon" id="NavCon">
            <a href="./admin_home.php" class="links">Home</a>
            <a href="./switch.php" class="links">Switch</a>
            <a href="./users.php" class="links">Users</a>
            <a href="./history.php" class="links">History</a>
            <a href="../backend/logout.php" class="btn btn-danger fs-4">Logout</a>
        </div>
        <button class="navBurger" onclick="handleNav()">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </button>
    </nav>
    <div class="top"></div>
    <section>
        <button class="addSwitchBtn" onclick="handleModal()">Add User</button>
        <div class="switchCon">
            <table class="table table-striped table-hover w-100"> 
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th >Status</th>
                    <th colspan="3">Edit</th>
                </tr>
                <?php 
                    $sql = "SELECT * FROM user_info WHERE status = 'Admin' or status = 'User' ORDER BY id DESC "; //get data from database
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
        </div>

        <div class="visibles" id="switchModal">
        <form action="../backend/register_api.php"  method="POST" >
            <a class="closeBtn" href="./users.php">&times;</a> 
            <div>
                    <div class="d-flex gap-3 flex-column w-75"> 
                        <input type="text" name="firstname" placeholder="Firstname" required class="form-control w-100">
                        <input type="text" name="lastname" placeholder="Lastname" required class="form-control w-100">
                        <input type="text" name="username" placeholder="Username" required class="form-control w-100">
                    </div>
                    <div class="d-flex gap-3 flex-column align-items-center  w-75"> 
                        <input type="text" name="password" placeholder="Password"  class="form-control w-100">
                        <input type="text" name="cpw" placeholder="Confirm Password"  class="form-control w-100" required>
                        <button type="submit" class="btn btn-primary w-100 p-3">Add</button>
                    </div>
            </div>   
            </form>
        </div>
        <a href="#top" class="btn btn-success position-fixed bottom-0 end-0 m-5 py-3 px-4 rounded-circle">^</a>
    </section>

    <script>

    //---Switch Modal
    const handleModal = () => {
        var modal = document.querySelector('#switchModal');
        if(modal.className == "visibles"){
            modal.className = "modals";
        }else{
            modal.className == "visibles";
        }
    }
    </script>
    <script src="./script.js"></script>
</body>
</html>