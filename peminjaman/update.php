<?php
session_start();
include "../database/koneksi.php";

$id = $_POST['id_peminjaman'];
$id_siswa = $_POST['id_siswa'];
$id_buku_baru = $_POST['id_buku'];
$jumlah_baru = $_POST['jumlah'];
$status_baru = $_POST['status'];

// Data lama
$lama = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT d.id_buku, d.jumlah, p.status
    FROM detail_peminjaman d
    JOIN peminjaman p ON d.id_peminjaman=p.id_peminjaman
    WHERE d.id_peminjaman='$id'
"));

$id_buku_lama = $lama['id_buku'];
$jumlah_lama  = $lama['jumlah'];
$status_lama  = $lama['status'];

mysqli_begin_transaction($koneksi);

try {
    // Kembalikan stok lama jika sebelumnya dipinjam
    if ($status_lama == 'dipinjam') {
        mysqli_query($koneksi, "
            UPDATE buku SET stok = stok + $jumlah_lama
            WHERE id_buku='$id_buku_lama'
        ");
    }

    // Kurangi stok baru jika status dipinjam
    if ($status_baru == 'dipinjam') {
        // cek stok
        $stok = mysqli_fetch_assoc(mysqli_query($koneksi,"
            SELECT stok FROM buku WHERE id_buku='$id_buku_baru'
        "));
        if ($jumlah_baru > $stok['stok']) {
            throw new Exception("Stok tidak cukup");
        }

        mysqli_query($koneksi, "
            UPDATE buku SET stok = stok - $jumlah_baru
            WHERE id_buku='$id_buku_baru'
        ");
    }

    // Update peminjaman
    mysqli_query($koneksi, "
        UPDATE peminjaman SET
        id_siswa='$id_siswa',
        status='$status_baru'
        WHERE id_peminjaman='$id'
    ");

    // Update detail
    mysqli_query($koneksi, "
        UPDATE detail_peminjaman SET
        id_buku='$id_buku_baru',
        jumlah='$jumlah_baru'
        WHERE id_peminjaman='$id'
    ");

    mysqli_commit($koneksi);
    header("Location: index.php");

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    echo "<script>
        alert('Update gagal: stok tidak mencukupi!');
        window.location='edit.php?id=$id';
    </script>";
}
