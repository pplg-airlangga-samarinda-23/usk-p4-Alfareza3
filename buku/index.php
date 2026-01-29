<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include "../database/koneksi.php";

$data = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" href="../assets/css/buku.css">
</head>
<body>

<div class="container">
    <h2>📘 Data Buku</h2>

    <a href="create.php" class="btn">+ Tambah Buku</a>
    <br><br>

    <table class="table">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_buku'] ?>" class="btn">Edit</a>
                <a href="delete.php?id=<?= $row['id_buku'] ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus buku?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="../dashboard.php" class="btn">← Dashboard</a>
</div>

</body>
</html>
