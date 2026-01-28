<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id'");
$siswa = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nis   = $_POST['nis'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($koneksi,
        "UPDATE siswa SET
         nis='$nis',
         nama='$nama',
         kelas='$kelas',
         no_hp='$no_hp'
         WHERE id_siswa='$id'"
    );

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Anggota</title></head>
<body>

<h2>Edit Anggota</h2>

<form method="post">
    <input type="text" name="nis" value="<?= $siswa['nis'] ?>" required><br><br>
    <input type="text" name="nama" value="<?= $siswa['nama'] ?>" required><br><br>
    <input type="text" name="kelas" value="<?= $siswa['kelas'] ?>"><br><br>
    <input type="text" name="no_hp" value="<?= $siswa['no_hp'] ?>"><br><br>
    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
