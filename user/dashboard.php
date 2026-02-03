<?php
include "auth.php";
include "../database/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];

// hitung data milik user ini saja
$dipinjam = mysqli_num_rows(mysqli_query($koneksi, "
    SELECT * FROM peminjaman 
    WHERE id_siswa='$id_siswa' AND status='dipinjam'
"));

$riwayat = mysqli_num_rows(mysqli_query($koneksi, "
    SELECT * FROM peminjaman 
    WHERE id_siswa='$id_siswa'
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div class="header">
    <h2>📚 Dashboard Siswa</h2>
    <div>
        Halo, <b><?= $_SESSION['username']; ?></b> |
        <a href="../logout.php" class="logout" onclick="return confirm('Yakin logout?')">Logout</a>
    </div>
</div>

<div class="container">

    <div class="cards">
        <div class="card">
            <h3>Buku Sedang Dipinjam</h3>
            <p><?= $dipinjam ?></p>
        </div>

        <div class="card">
            <h3>Total Riwayat Peminjaman</h3>
            <p><?= $riwayat ?></p>
        </div>
    </div>

    <div class="menu">
        <a href="pinjam.php">📘 Pinjam Buku</a>
        <a href="riwayat.php">📄 Riwayat Peminjaman</a>
        <a href="kembali.php">🔁 Pengembalian Buku</a>
    </div>

</div>

</body>
</html>
