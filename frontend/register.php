
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css  "/>
    <script src="./bootstrap/js/bootstrap.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="d-flex align-items-center vh-100 w-100 justify-content-center bg-dark-subtle position-relative">
    <form action="../backend/register_api.php"  method="POST"  class="d-flex flex-column align-items-center justify-content-center p-5 bg-white shadow rounded gap-4">
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
</body>
</html>




