<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <b><?= $_SESSION['nama']; ?></b></p>

<ul>
    <li><a href="buku/index.php">Kelola Buku</a></li>
    <li><a href="siswa/index.php">Kelola Siswa</a></li>
    <li><a href="peminjaman/index.php">Transaksi Peminjaman</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
