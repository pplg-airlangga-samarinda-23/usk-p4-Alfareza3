<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

if (isset($_POST['simpan'])) {
    $nis   = $_POST['nis'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($koneksi,
        "INSERT INTO siswa (nis, nama, kelas, no_hp)
         VALUES ('$nis','$nama','$kelas','$no_hp')"
    );

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Tambah Anggota</title></head>
<body>

<h2>Tambah Anggota</h2>

<form method="post">
    <label>NIS</label><br>
    <input type="text" name="nis" required><br><br>

    <label>Nama</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Kelas</label><br>
    <input type="text" name="kelas"><br><br>

    <label>No HP</label><br>
    <input type="text" name="no_hp"><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

</body>
</html>
