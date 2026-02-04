<?php
session_start();
include "../database/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi,"
    UPDATE akun_siswa SET password='123'
    WHERE id_akun='$id'
");

echo "<script>
    alert('Password berhasil direset ke 123');
    window.location='password.php?id=$id';
</script>";
