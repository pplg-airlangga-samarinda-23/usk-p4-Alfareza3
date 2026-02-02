<?php
session_start();
include "../database/koneksi.php";

$id = $_GET['id'];

// Ambil data
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT p.status, d.id_buku, d.jumlah
    FROM peminjaman p
    JOIN detail_peminjaman d ON p.id_peminjaman=d.id_peminjaman
    WHERE p.id_peminjaman='$id'
"));

mysqli_begin_transaction($koneksi);

try {
    // Kembalikan stok jika masih dipinjam
    if ($d['status'] == 'dipinjam') {
        mysqli_query($koneksi, "
            UPDATE buku SET stok = stok + {$d['jumlah']}
            WHERE id_buku='{$d['id_buku']}'
        ");
    }

    // Hapus detail & peminjaman
    mysqli_query($koneksi, "DELETE FROM detail_peminjaman WHERE id_peminjaman='$id'");
    mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");

    mysqli_commit($koneksi);
    header("Location: index.php");

} catch (Exception $e) {
    mysqli_rollback($koneksi);
    echo "Gagal menghapus data";
}
