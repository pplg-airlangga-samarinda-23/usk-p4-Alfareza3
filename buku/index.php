<?php
include "../database/koneksi.php";
$data = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
</head>
<body>

<h2>Data Buku</h2>
<a href="create.php">+ Tambah Buku</a>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php $no=1; while($row = mysqli_fetch_assoc($data)) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['judul'] ?></td>
        <td><?= $row['penulis'] ?></td>
        <td><?= $row['stok'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_buku'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id_buku'] ?>"
               onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<br>
<a href="../dashboard.php">← Kembali ke Dashboard</a>
</body>
</html>
