<?php
session_start();
include "../database/koneksi.php";

if (isset($_POST['pinjam'])) {

    $id_siswa = $_POST['id_siswa'];
    $id_buku  = $_POST['id_buku'];
    $jumlah   = $_POST['jumlah'];
    $id_admin = $_SESSION['id_admin'];

    $qBuku = mysqli_query($koneksi,
        "SELECT stok FROM buku WHERE id_buku='$id_buku'"
    );
    $buku = mysqli_fetch_assoc($qBuku);

    if ($jumlah > $buku['stok']) {
        echo "<script>
            alert('Jumlah buku melebihi stok yang tersedia!');
            window.location='create.php';
        </script>";
        exit;
    }

    mysqli_begin_transaction($koneksi);

    try {
        mysqli_query($koneksi, "
            INSERT INTO peminjaman (id_siswa,id_admin,tanggal_pinjam,status)
            VALUES ('$id_siswa','$id_admin',NOW(),'dipinjam')
        ");
        $id_peminjaman = mysqli_insert_id($koneksi);

        mysqli_query($koneksi, "
            INSERT INTO detail_peminjaman (id_peminjaman,id_buku,jumlah)
            VALUES ('$id_peminjaman','$id_buku','$jumlah')
        ");

        mysqli_query($koneksi, "
            UPDATE buku
            SET stok = stok - $jumlah
            WHERE id_buku='$id_buku'
        ");

        mysqli_commit($koneksi);
        header("Location: index.php");

    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        echo "Gagal memproses peminjaman";
    }
}
