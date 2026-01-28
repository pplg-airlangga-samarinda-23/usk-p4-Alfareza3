<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";
$data = mysqli_query($koneksi, "SELECT * FROM siswa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
</head>
<body>

<h2>Data Anggota / Siswa</h2>
<a href="create.php">+ Tambah Anggota</a>
<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>

    <?php $no=1; while($row = mysqli_fetch_assoc($data)) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nis'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['kelas'] ?></td>
        <td><?= $row['no_hp'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_siswa'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id_siswa'] ?>"
               onclick="return confirm('Yakin hapus anggota?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<br>
<a href="../dashboard.php">← Kembali ke Dashboard</a>
</body>
</html>
