<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id_akun = $_GET['id'];

$user = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT a.username, s.nama, s.kelas
    FROM akun_siswa a
    JOIN siswa s ON a.id_siswa = s.id_siswa
    WHERE a.id_akun='$id_akun'
"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Password</title>
    <link rel="stylesheet" href="../assets/css/siswa.css">
</head>
<body>

<div class="container">
<h2>🔐 Kelola Akun Siswa</h2>

<p>
<b>Nama:</b> <?= $user['nama'] ?><br>
<b>Kelas:</b> <?= $user['kelas'] ?><br>
<b>Username:</b> <?= $user['username'] ?>
</p>

<div class="form-box">
    <a href="password_edit.php?id=<?= $id_akun ?>" class="btn">Edit Username</a>
    <br><br>
    <a href="password_reset.php?id=<?= $id_akun ?>"
       onclick="return confirm('Reset password ke default?')"
       class="btn btn-success">
       Reset Password
    </a>
    <br><br>
    <a href="password_delete.php?id=<?= $id_akun ?>"
       onclick="return confirm('Hapus akun user ini?')"
       class="btn btn-danger">
       Hapus Akun
    </a>
</div>

<br>
<a href="index.php" class="btn">← Kembali</a>
</div>

</body>
</html>
