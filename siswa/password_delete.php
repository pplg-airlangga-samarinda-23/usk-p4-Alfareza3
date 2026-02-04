<?php
session_start();
include "../database/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi,"
    DELETE FROM akun_siswa WHERE id_akun='$id'
");

echo "<script>
    alert('Akun user berhasil dihapus');
    window.location='index.php';
</script>";
