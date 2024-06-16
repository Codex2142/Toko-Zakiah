<?php
session_start();

if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: admin.php');
    exit();
}

// Check if session has expired
if (time() > $_SESSION['expire_time']) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'Admin2745!' && $password == 'TokoZakiah1') {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $_SESSION['login_time'] = time();

        // Set session to expire in 6 hours
        $_SESSION['expire_time'] = $_SESSION['login_time'] + (6 * 60 * 60);

        header('Location: admin.php');
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin-top: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Login Page</h2>
    
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
