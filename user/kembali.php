<?php
include "auth.php";
include "../database/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];

// Ambil peminjaman yang masih dipinjam oleh user ini
$data = mysqli_query($koneksi, "
    SELECT 
        p.id_peminjaman,
        p.tanggal_pinjam,
        p.status
    FROM peminjaman p
    WHERE p.id_siswa = '$id_siswa'
      AND p.status = 'dipinjam'
    ORDER BY p.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>🔁 Pengembalian Buku</h2>

<?php if (mysqli_num_rows($data) == 0): ?>
    <p>Tidak ada buku yang sedang dipinjam.</p>
<?php else: ?>

<table class="table">
<tr>
    <th>No</th>
    <th>Tanggal & Jam Pinjam</th>
    <th>Detail Buku</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>

    <td>
        <?= date('d-m-Y H:i:s', strtotime($row['tanggal_pinjam'])) ?>
    </td>

    <td>
        <?php
        // Ambil detail buku per transaksi
        $detail = mysqli_query($koneksi, "
            SELECT b.judul, d.jumlah
            FROM detail_peminjaman d
            JOIN buku b ON d.id_buku = b.id_buku
            WHERE d.id_peminjaman = '{$row['id_peminjaman']}'
        ");

        while ($d = mysqli_fetch_assoc($detail)) {
            echo "- {$d['judul']} ({$d['jumlah']} buku)<br>";
        }
        ?>
    </td>

    <td>
        <a href="kembali_proses.php?id=<?= $row['id_peminjaman'] ?>"
           onclick="return confirm('Yakin ingin mengembalikan buku ini?')"
           class="btn btn-success">
           Kembalikan
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

<?php endif; ?>

<br>
<a href="dashboard.php" class="btn">← Kembali</a>
</div>

</body>
</html>
