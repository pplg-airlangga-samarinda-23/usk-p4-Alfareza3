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
    <title>Data Siswa</title>
    <link rel="stylesheet" href="../assets/css/siswa.css">
</head>
<body>

<div class="container">
    <h2>👨‍🎓 Data Anggota / Siswa</h2>

    <a href="create.php" class="btn">+ Tambah Siswa</a>
    <br><br>

    <table class="table">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['kelas'] ?></td>
            <td><?= $row['no_hp'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_siswa'] ?>" class="btn">Edit</a>
                <a href="delete.php?id=<?= $row['id_siswa'] ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus siswa?')">
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
