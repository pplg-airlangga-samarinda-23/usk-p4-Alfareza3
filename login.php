<?php
session_start();
include "database/koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi,
        "SELECT * FROM admin 
         WHERE username='$username' AND password='$password'"
    );

    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['nama'] = $data['nama'];

        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Username atau Password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="footer-text">
        © Perpustakaan Sekolah Digital
    </div>
</div>

</body>
</html>

