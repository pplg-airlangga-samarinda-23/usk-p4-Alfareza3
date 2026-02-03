<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id = $_GET['id'];

// 1. Cek apakah siswa pernah / sedang meminjam buku
$cekPeminjaman = mysqli_query($koneksi, "
    SELECT * FROM peminjaman 
    WHERE id_siswa='$id'
");

if (mysqli_num_rows($cekPeminjaman) > 0) {
    echo "<script>
        alert('Siswa tidak dapat dihapus karena memiliki riwayat peminjaman buku!');
        window.location='index.php';
    </script>";
    exit;
}

// 2. Cek apakah siswa memiliki akun user
$cekAkun = mysqli_query($koneksi, "
    SELECT * FROM akun_siswa 
    WHERE id_siswa='$id'
");

if (mysqli_num_rows($cekAkun) > 0) {
    echo "<script>
        alert('Siswa tidak dapat dihapus karena sudah memiliki akun user!');
        window.location='index.php';
    </script>";
    exit;
}

// 3. Jika aman, hapus siswa
mysqli_query($koneksi, "
    DELETE FROM siswa WHERE id_siswa='$id'
");

echo "<script>
    alert('Data siswa berhasil dihapus.');
    window.location='index.php';
</script>";
