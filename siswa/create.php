<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include "../database/koneksi.php";

if (isset($_POST['simpan'])) {
    mysqli_query($koneksi, "
        INSERT INTO siswa (nis, nama, kelas, no_hp)
        VALUES ('$_POST[nis]', '$_POST[nama]', '$_POST[kelas]', '$_POST[no_hp]')
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="../assets/css/siswa.css">
</head>
<body>

<div class="container">
    <h2>Tambah Siswa</h2>

    <div class="form-box">
        <form method="post">
            <label>NIS</label>
            <input type="text" name="nis" required>

            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Kelas</label>
            <input type="text" name="kelas">

            <label>No HP</label>
            <input type="text" name="no_hp">

            <button type="submit" name="simpan" class="btn">Simpan</button>
            <br><br>
            <a href="index.php" class="btn">← Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
