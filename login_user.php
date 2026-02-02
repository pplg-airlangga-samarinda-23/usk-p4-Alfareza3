<?php
session_start();
include "database/koneksi.php";

if (isset($_SESSION['login']) && $_SESSION['role'] == 'user') {
    header("Location: user/dashboard.php");
    exit;
}

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Login user (siswa)
    $query = mysqli_query($koneksi, "
        SELECT * FROM akun_siswa 
        WHERE username='$username' AND password='$password'
    ");

    if (mysqli_num_rows($query) > 0) {

        $user = mysqli_fetch_assoc($query);

        $_SESSION['login'] = true;
        $_SESSION['role']  = 'user';
        $_SESSION['id_siswa'] = $user['id_siswa'];
        $_SESSION['username'] = $user['username'];

        header("Location: user/dashboard.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <!-- CSS SAMA DENGAN LOGIN ADMIN -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="login-box">
    <h2>Login User</h2>

    <?php if (isset($error)): ?>
        <p style="color:red; text-align:center;">
            <?= $error ?>
        </p>
    <?php endif; ?>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>
    <a href="register_user.php" style="display:block;text-align:center;margin-top:10px;">
    Belum punya akun? Daftar
    </a>
    <a href="index.php" style="display:block;text-align:center;margin-top:10px;">Kembali</a>
    <div class="footer-text">
        © Perpustakaan Sekolah Digital
    </div>
</div>

</body>
</html>
