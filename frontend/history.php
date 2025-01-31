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
    <title>Admin | History</title>
    <link rel="stylesheet" href="./styles/history.css">
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
    <div id="top"></div>
    <section>
        <div class="switchCon" id="">
            <table class="table table-stripe table-striped table-hover">
                <tr>
                    <th>User</th>
                    <th>Switch</th>
                    <th>Description</th>
                    <th>Timestamp</th> 
                </tr>

                <?php 
                $sql = "SELECT * FROM switch_logs ORDER BY timestamp DESC"; //get data from database
                $Result = $conn->query($sql); // query
                while ($row = $Result->fetch_assoc()) { //display data
                ?>

                <tr>
                    <td> <?php echo $row['fullname']; ?> </td>
                    <td> <?php echo $row['switch_name']; ?> </td>
                    <td> <?php echo $row['description']; ?> </td>
                    <td> <?php echo $row['timestamp']; ?> </td>
                </tr>
                
                <?php   
                }
                ?>

            </table>
        </div>

        <div class="visibles" id="switchModal">
            <form action="../backend/add_switch_api.php" method="POST" class="d-flex justify-content-center flex-column p-5 gap-3">
                <a class="closeBtn" href="./users.php">&times;</a> 
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