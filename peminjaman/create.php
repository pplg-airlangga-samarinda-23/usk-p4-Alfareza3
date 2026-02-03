<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php"); exit;
}
include "../database/koneksi.php";

$siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
$buku  = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0");
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Peminjaman</title>
<link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>Tambah Peminjaman</h2>

<div class="form-box">
<form action="proses.php" method="post">
    <label>Siswa</label>
    <select name="id_siswa" required>
        <?php while($s=mysqli_fetch_assoc($siswa)): ?>
            <option value="<?= $s['id_siswa'] ?>"><?= $s['nama'] ?></option>
        <?php endwhile; ?>
    </select>

    <label>Buku</label>
    <select name="id_buku" required>
        <?php while($b=mysqli_fetch_assoc($buku)): ?>
            <option value="<?= $b['id_buku'] ?>">
                <?= $b['judul'] ?> (stok <?= $b['stok'] ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <label>Jumlah</label>
    <input type="number" name="jumlah"
        min="1"
        max="<?= $b['stok']; ?>"
        required>

    <button type="submit" name="pinjam" class="btn">Simpan</button>
</form>
<br>
<a href="index.php" class="btn">← Kembali</a>
</div>
</div>

</body>
</html>
