<?php
session_start();
include "../database/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['kembali'])) {

    $id_peminjaman = $_POST['id_peminjaman'];

    $cek = mysqli_query($koneksi, "
        SELECT status FROM peminjaman 
        WHERE id_peminjaman = '$id_peminjaman'
    ");
    $data = mysqli_fetch_assoc($cek);

    switch ($data['status']) {

        case 'dikembalikan':
            $_SESSION['alert'] = 'sudah_dikembalikan';
            header("Location: index.php");
            exit;
        break;

        case 'dipinjam':

            mysqli_begin_transaction($koneksi);

            try {
                mysqli_query($koneksi, "
                    UPDATE peminjaman
                    SET status = 'dikembalikan',
                        tanggal_kembali = NOW()
                    WHERE id_peminjaman = '$id_peminjaman'
                ");

                mysqli_query($koneksi, "
                    UPDATE buku b
                    JOIN detail_peminjaman d 
                        ON b.id_buku = d.id_buku
                    SET b.stok = b.stok + d.jumlah
                    WHERE d.id_peminjaman = '$id_peminjaman'
                ");

                mysqli_commit($koneksi);

                $_SESSION['alert'] = 'berhasil';
                header("Location: index.php");
                exit;

            } catch (Exception $e) {
                mysqli_rollback($koneksi);
                $_SESSION['alert'] = 'gagal';
                header("Location: index.php");
                exit;
            }

        break;

        default:
            $_SESSION['alert'] = 'error';
            header("Location: index.php");
            exit;
    }
}
