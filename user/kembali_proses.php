<?php
include "auth.php";
include "../database/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];
$id_peminjaman = $_GET['id'];

// Pastikan peminjaman milik user ini & masih dipinjam
$cek = mysqli_query($koneksi, "
    SELECT * FROM peminjaman
    WHERE id_peminjaman='$id_peminjaman'
      AND id_siswa='$id_siswa'
      AND status='dipinjam'
");

if (mysqli_num_rows($cek) == 0) {
    echo "<script>
        alert('Data tidak valid!');
        window.location='kembali.php';
    </script>";
    exit;
}

mysqli_begin_transaction($koneksi);

try {
    // Update status peminjaman
    mysqli_query($koneksi, "
        UPDATE peminjaman
        SET status='dikembalikan',
            tanggal_kembali=NOW()
        WHERE id_peminjaman='$id_peminjaman'
    ");

    // Kembalikan stok buku
    mysqli_query($koneksi, "
        UPDATE buku b
        JOIN detail_peminjaman d ON b.id_buku=d.id_buku
        SET b.stok = b.stok + d.jumlah
        WHERE d.id_peminjaman='$id_peminjaman'
    ");

    mysqli_commit($koneksi);

    echo "<script>
        alert('Buku berhasil dikembalikan!');
        window.location='kembali.php';
    </script>";

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    echo "<script>
        alert('Gagal mengembalikan buku!');
        window.location='kembali.php';
    </script>";
}
