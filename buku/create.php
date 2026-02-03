<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include "../database/koneksi.php";

if (isset($_POST['simpan'])) {
    mysqli_query($koneksi, "
        INSERT INTO buku (judul, penulis, tahun_terbit, kategori, stok)
        VALUES (
            '$_POST[judul]',
            '$_POST[penulis]',
            '$_POST[tahun_terbit]',
            '$_POST[kategori]',
            '$_POST[stok]'
        )
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../assets/css/buku.css">
</head>
<body>

<div class="container">
    <h2>📘 Tambah Buku</h2>

    <div class="form-box">
        <form method="post">

            <label>Judul Buku</label>
            <input type="text" name="judul" required>

            <label>Penulis</label>
            <input type="text" name="penulis" required>

            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" min="1" max="<?= date('Y') ?>" required>

            <label>Kategori</label>
            <input type="text" name="kategori" placeholder="Contoh: Novel, Teknologi" required>

            <label>Stok</label>
            <input type="number" name="stok" min="1" required>

            <button type="submit" name="simpan" class="btn">Simpan</button>
            <br><br>
            <a href="index.php" class="btn">← Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
