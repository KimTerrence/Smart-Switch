<?php 
    session_start();
    include '../backend/database_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Switch</title>
    <link rel="stylesheet" href="./styles/switch.css">
</head>
<body>
    <nav>
        <p class="subtitle">Switch</p>
        <a href="./admin_home.php">Home</a>
        <a href="./switch.php">Switch</a>
        <a href="">Users</a>
        <a href="">History</a>
        <a href="../backend/logout.php" class="logoutBtn">Logout</a>
    </nav>
    <section>
        <button class="addSwitchBtn" onclick="handleModal()">Add Switch</button>
        <div class="switchCon">
            <table >
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

        <div class="visible" id="switchModal">
            <form action="../backend/add_switch_api.php" method="POST" class="d-flex justify-content-center flex-column p-5 gap-2">
                <a class="closeBtn" href="./switch.php">&times;</a> 
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