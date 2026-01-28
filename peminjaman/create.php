<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include "../database/koneksi.php";

$siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
$buku  = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0");
?>

<!DOCTYPE html>
<html>
<head><title>Peminjaman Buku</title></head>
<body>

<h2>Peminjaman Buku</h2>

<form action="proses.php" method="post">
    <label>Siswa</label><br>
    <select name="id_siswa" required>
        <option value="">-- Pilih Siswa --</option>
        <?php while($s=mysqli_fetch_assoc($siswa)): ?>
            <option value="<?= $s['id_siswa'] ?>">
                <?= $s['nama'] ?> (<?= $s['kelas'] ?>)
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Buku</label><br>
    <select name="id_buku" required>
        <option value="">-- Pilih Buku --</option>
        <?php while($b=mysqli_fetch_assoc($buku)): ?>
            <option value="<?= $b['id_buku'] ?>">
                <?= $b['judul'] ?> (stok: <?= $b['stok'] ?>)
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Jumlah</label><br>
    <input type="number" name="jumlah" value="1" min="1" required><br><br>

    <button type="submit" name="pinjam">Simpan</button>
</form>

</body>
</html>
