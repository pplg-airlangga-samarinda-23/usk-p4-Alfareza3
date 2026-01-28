<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "
    SELECT p.id_peminjaman, s.nama, p.tanggal_pinjam
    FROM peminjaman p
    JOIN siswa s ON p.id_siswa = s.id_siswa
    WHERE p.id_peminjaman = '$id'
");
$p = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head><title>Pengembalian Buku</title></head>
<body>

<h2>Pengembalian Buku</h2>

<p>Nama Siswa : <b><?= $p['nama'] ?></b></p>
<p>Tanggal Pinjam : <?= $p['tanggal_pinjam'] ?></p>

<form action="proses_kembali.php" method="post">
    <input type="hidden" name="id_peminjaman" value="<?= $p['id_peminjaman'] ?>">
    <button type="submit" name="kembali">
        Konfirmasi Pengembalian
    </button>
</form>

</body>
</html>
