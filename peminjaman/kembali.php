<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id = $_GET['id'];

$peminjaman = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT 
        p.id_peminjaman,
        s.nama,
        p.tanggal_pinjam,
        p.status
    FROM peminjaman p
    JOIN siswa s ON p.id_siswa = s.id_siswa
    WHERE p.id_peminjaman = '$id'
"));

$detail = mysqli_query($koneksi, "
    SELECT b.judul, d.jumlah
    FROM detail_peminjaman d
    JOIN buku b ON d.id_buku = b.id_buku
    WHERE d.id_peminjaman = '$id'
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

    <div class="form-box">

        <p><b>Nama Siswa</b> : <?= $peminjaman['nama']; ?></p>
        <p><b>Tanggal & Jam Pinjam</b> : 
            <?= date('d-m-Y H:i:s', strtotime($peminjaman['tanggal_pinjam'])); ?>
        </p>
        <p><b>Status</b> :
            <?php if ($peminjaman['status'] == 'dipinjam'): ?>
                <span class="status-dipinjam">Dipinjam</span>
            <?php else: ?>
                <span class="status-kembali">Dikembalikan</span>
            <?php endif; ?>
        </p>

        <hr>

        <p><b>Daftar Buku Dipinjam:</b></p>

        <table class="table">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
            </tr>
            <?php $no=1; while($d = mysqli_fetch_assoc($detail)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['judul']; ?></td>
                <td><?= $d['jumlah']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <br>

        <?php if ($peminjaman['status'] == 'dipinjam'): ?>
            <form action="proses_kembali.php" method="post">
                <input type="hidden" name="id_peminjaman" value="<?= $id; ?>">
                <button type="submit" name="kembali" class="btn btn-success">
                    Konfirmasi Pengembalian
                </button>
            </form>
        <?php else: ?>
            <p><b>Buku sudah dikembalikan.</b></p>
        <?php endif; ?>

        <br>
        <a href="index.php" class="btn">← Kembali</a>

    </div>
</div>

</body>
</html>
