<?php 
    session_start();
    include '../backend/database_config.php';

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
    <title>Admin | Switch</title>
    <link rel="stylesheet" href="./styles/switch.css">
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
        <button class="addSwitchBtn" onclick="handleModal()">Add Switch</button>
        <div class="switchCon">
            <table class="table">
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

        <div class="visibles" id="switchModal">
            <form action="../backend/add_switch_api.php" method="POST" class="d-flex justify-content-center flex-column p-5 gap-3">
                <a class="closeBtn" href="./switch.php">&times;</a> 
                <input type="text" name="name" placeholder="Name:" class="form-control" required>
                <input type="text" name="ip" placeholder="Ip Address:" class="form-control" required>
               <div class="d-flex gap-1 align-items-center justify-content-between">
                    <label for="motion">Motion Sensor</label>
                    <select name="motion" id="motion" class="form-select w-50">
                        <option value="disabled">Disable</option>
                        <option value="off">Enable</option>
                    </select>
               </div>
               <div class="d-flex gap-1 align-items-center justify-content-between">
                    <label for="light">Ligth Sensor</label>
                    <select name="light" id="light" class="form-select w-50">
                        <option value="disabled">Disable</option>
                        <option value="off">Enable</option>
                    </select>
               </div>
                <button type="submit" class="btn btn-primary p-3">Save changes</button>
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