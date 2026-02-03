<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include "database/koneksi.php";

$jumlah_buku  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$jumlah_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
$dipinjam     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='dipinjam'"));
$kembali      = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='dikembalikan'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="header">
    <h2>📚 Dashboard Admin</h2>
    <div>
        Halo, <b><?= $_SESSION['nama']; ?></b> |
        <a href="#" class="logout" onclick="return confirmLogout()">Logout</a>
    </div>
</div>

<div class="container">

    <div class="cards">
        <div class="card">
            <h3>Total Buku</h3>
            <p><?= $jumlah_buku ?></p>
        </div>

        <div class="card">
            <h3>Total Siswa</h3>
            <p><?= $jumlah_siswa ?></p>
        </div>

        <div class="card">
            <h3>Buku Dipinjam</h3>
            <p><?= $dipinjam ?></p>
        </div>

        <div class="card">
            <h3>Buku Dikembalikan</h3>
            <p><?= $kembali ?></p>
        </div>
    </div>

    <div style="margin-top:40px; max-width:400px;">
        <h3>📊 Statistik Peminjaman</h3>
        <canvas id="peminjamanChart"></canvas>
    </div>

    <div class="menu" style="margin-top:40px;">
        <a href="buku/index.php">📘 Kelola Buku</a>
        <a href="siswa/index.php">👨‍🎓 Kelola Siswa</a>
        <a href="peminjaman/index.php">🔄 Transaksi Peminjaman</a>
    </div>

</div>

<script>
const ctx = document.getElementById('peminjamanChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Dipinjam', 'Dikembalikan'],
        datasets: [{
            data: [<?= $dipinjam ?>, <?= $kembali ?>],
            backgroundColor: ['#e74a3b', '#1cc88a']
        }]
    }
});

function confirmLogout() {
    if (confirm('Yakin ingin logout dari sistem?')) {
        window.location.href = 'logout.php';
    }
    return false;
}
</script>

</body>
</html>
