<?php
include "auth.php";
include "../database/koneksi.php";

// Ambil buku yang masih ada stok
$buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>
    <link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>📘 Pinjam Buku</h2>

<?php if (mysqli_num_rows($buku) == 0): ?>
    <p>Tidak ada buku yang tersedia.</p>
<?php else: ?>

<div class="form-box">
<form action="pinjam_proses.php" method="post">

    <label>Pilih Buku</label>
    <select name="id_buku" required>
        <option value="">-- Pilih Buku --</option>
        <?php while($b=mysqli_fetch_assoc($buku)): ?>
            <option value="<?= $b['id_buku']; ?>">
                <?= $b['judul']; ?> (stok: <?= $b['stok']; ?>)
            </option>
        <?php endwhile; ?>
    </select>

    <label>Jumlah</label>
    <input type="number" name="jumlah" min="1" required>

    <button type="submit" name="pinjam" class="btn">
        Pinjam Buku
    </button>

</form>
</div>

<?php endif; ?>

<br>
<a href="dashboard.php" class="btn">← Kembali</a>
</div>

</body>
</html>
