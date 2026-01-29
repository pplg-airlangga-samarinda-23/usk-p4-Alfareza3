<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php"); exit;
}
include "../database/koneksi.php";

$data = mysqli_query($koneksi, "
    SELECT p.id_peminjaman, s.nama, p.tanggal_pinjam, p.tanggal_kembali, p.status
    FROM peminjaman p
    JOIN siswa s ON p.id_siswa = s.id_siswa
    ORDER BY p.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>🔄 Data Peminjaman</h2>

<a href="create.php" class="btn">+ Tambah Peminjaman</a>
<br><br>

<table class="table">
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Pinjam</th>
    <th>Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal_pinjam'])) ?></td>
    <td><?= $row['tanggal_kembali'] ? date('d-m-Y H:i:s', strtotime($row['tanggal_kembali'])) : '-' ?></td>
    <td>
        <?php if($row['status']=='dipinjam'): ?>
            <span class="status-dipinjam">Dipinjam</span>
        <?php else: ?>
            <span class="status-kembali">Dikembalikan</span>
        <?php endif; ?>
    </td>
    <td>
        <?php if($row['status']=='dipinjam'): ?>
            <a href="kembali.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-success">Pengembalian</a>
        <?php else: ?>
            Selesai
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>
<br>
<a href="../dashboard.php" class="btn">← Dashboard</a>
</div>

</body>
</html>
