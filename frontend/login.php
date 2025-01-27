<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="">
    <form action="../backend/login_api.php" method="POST" class="w-25 d-flex flex-column align-items-center justify-content-center gap-4 bg-white rounded shadow  p-5">
    <p class="fw-bold fs-1">Login</p>
    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
        <input type="text" id="username" name="username" required class="form-control" placeholder="Username" />       
        <input type="password" id="password" name="password" required class="form-control" placeholder="Password" >
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <div class="py-2">
        </div>
    </form>
</body>
</html>
