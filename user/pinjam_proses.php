<?php
include "auth.php";
include "../database/koneksi.php";

if (!isset($_POST['pinjam'])) {
    header("Location: pinjam.php");
    exit;
}

$id_siswa = $_SESSION['id_siswa'];
$id_buku  = $_POST['id_buku'];
$jumlah   = $_POST['jumlah'];

// Ambil stok asli buku
$q = mysqli_query($koneksi, "
    SELECT stok FROM buku WHERE id_buku='$id_buku'
");
$buku = mysqli_fetch_assoc($q);

// VALIDASI STOK
if ($jumlah <= 0 || $jumlah > $buku['stok']) {
    echo "<script>
        alert('Jumlah buku melebihi stok yang tersedia!');
        window.location='pinjam.php';
    </script>";
    exit;
}

mysqli_begin_transaction($koneksi);

try {
    // Simpan peminjaman (tanpa admin)
    mysqli_query($koneksi, "
        INSERT INTO peminjaman 
        (id_siswa, tanggal_pinjam, status)
        VALUES 
        ('$id_siswa', NOW(), 'dipinjam')
    ");

    $id_peminjaman = mysqli_insert_id($koneksi);

    // Simpan detail buku
    mysqli_query($koneksi, "
        INSERT INTO detail_peminjaman 
        (id_peminjaman, id_buku, jumlah)
        VALUES 
        ('$id_peminjaman', '$id_buku', '$jumlah')
    ");

    // Kurangi stok
    mysqli_query($koneksi, "
        UPDATE buku
        SET stok = stok - $jumlah
        WHERE id_buku='$id_buku'
    ");

    mysqli_commit($koneksi);

    echo "<script>
        alert('Buku berhasil dipinjam!');
        window.location='dashboard.php';
    </script>";

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    echo "<script>
        alert('Gagal meminjam buku!');
        window.location='pinjam.php';
    </script>";
}
