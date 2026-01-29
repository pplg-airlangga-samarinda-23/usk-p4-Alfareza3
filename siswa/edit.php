<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include "../database/koneksi.php";

$id = $_GET['id'];
$siswa = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id'")
);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "
        UPDATE siswa SET
        nis='$_POST[nis]',
        nama='$_POST[nama]',
        kelas='$_POST[kelas]',
        no_hp='$_POST[no_hp]'
        WHERE id_siswa='$id'
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="../assets/css/siswa.css">
</head>
<body>

<div class="container">
    <h2>Edit Siswa</h2>

    <div class="form-box">
        <form method="post">
            <label>NIS</label>
            <input type="text" name="nis" value="<?= $siswa['nis'] ?>" required>

            <label>Nama</label>
            <input type="text" name="nama" value="<?= $siswa['nama'] ?>" required>

            <label>Kelas</label>
            <input type="text" name="kelas" value="<?= $siswa['kelas'] ?>">

            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $siswa['no_hp'] ?>">

            <button type="submit" name="update" class="btn">Update</button>
            <br><br>
            <a href="index.php" class="btn">← Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
