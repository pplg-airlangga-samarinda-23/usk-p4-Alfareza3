<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php"); exit;
}
include "../database/koneksi.php";

$id = $_GET['id'];

// Data peminjaman
$p = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM peminjaman WHERE id_peminjaman='$id'
"));

// Detail buku
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM detail_peminjaman WHERE id_peminjaman='$id'
"));

$siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
$buku  = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Peminjaman</title>
<link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>✏️ Edit Peminjaman</h2>

<div class="form-box">
<form action="update.php" method="post">

<input type="hidden" name="id_peminjaman" value="<?= $id ?>">

<label>Siswa</label>
<select name="id_siswa" required>
<?php while($s=mysqli_fetch_assoc($siswa)): ?>
    <option value="<?= $s['id_siswa'] ?>" <?= $s['id_siswa']==$p['id_siswa']?'selected':'' ?>>
        <?= $s['nama'] ?>
    </option>
<?php endwhile; ?>
</select>

<label>Buku</label>
<select name="id_buku" required>
<?php while($b=mysqli_fetch_assoc($buku)): ?>
    <option value="<?= $b['id_buku'] ?>" <?= $b['id_buku']==$d['id_buku']?'selected':'' ?>>
        <?= $b['judul'] ?>
    </option>
<?php endwhile; ?>
</select>

<label>Jumlah</label>
<input type="number" name="jumlah" value="<?= $d['jumlah'] ?>" min="1" required>

<label>Status</label>
<select name="status">
    <option value="dipinjam" <?= $p['status']=='dipinjam'?'selected':'' ?>>Dipinjam</option>
    <option value="dikembalikan" <?= $p['status']=='dikembalikan'?'selected':'' ?>>Dikembalikan</option>
</select>

<button type="submit" class="btn">Update</button>
</form>
</div>

<br>
<a href="index.php" class="btn">← Kembali</a>
</div>

</body>
</html>
