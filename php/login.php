<?php
    include("koneksi.php");

    // Memeriksa apakah form telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil nilai username dan password dari form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Lindungi dari SQL Injection
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        // Query untuk memeriksa username dan password
        $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 1) {
            // Jika username dan password cocok
            // Redirect ke halaman admin.php
            header("Location: admin.php");
            exit(); // Penting: pastikan untuk keluar dari skrip setelah redirect
        } else {
            // Jika username atau password salah
            $error = "Username atau password salah.";
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
