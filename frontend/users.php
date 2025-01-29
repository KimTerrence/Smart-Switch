<?php 
include '../backend/database_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="shortcut icon" href="./assets/BULB1.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/user.css">
</head>
<body>
    <nav>
        <p class="subtitle">Admin Dashboard</p>
        <a href="./admin_home.php">Home</a>
        <a href="./switch.php">Switch</a>
        <a href="./users.php">Users</a>
        <a href="">History</a>
        <a href="../backend/logout.php" class="logoutBtn">Logout</a>
    </nav>
    <section class="userCon">
        <button class="addSwitchBtn" onclick="handleModal()">Add Users</button>
        <div class="switchCon">
            <table >
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th >Status</th>
                <th colspan="3">Edit</th>
            </tr>
            <?php 
                $sql = "SELECT * FROM user_info WHERE status = 'User' Or status = 'Admin' ORDER BY id DESC"; //get data from database
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

        <div class="visible" id="switchModal">
        <form action="../backend/register_api.php"  method="POST"  class="d-flex flex-column align-items-center justify-content-center p-5 bg-white rounded gap-4">
            <a class="closeBtn" href="./switch.php">&times;</a> 
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
        </div>
    </section>

    <script>

    //---Switch Modal
    const handleModal = () => {
        var modal = document.querySelector('#switchModal');
        if(modal.className == "visible"){
            modal.className = "modal";
        }else{
            modal.className == "visible";
        }
    }
    </script>
</body>
</html>