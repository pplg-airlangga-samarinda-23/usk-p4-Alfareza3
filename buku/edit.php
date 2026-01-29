<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include "../database/koneksi.php";

$id = $_GET['id'];
$buku = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'")
);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "
        UPDATE buku SET
        judul='$_POST[judul]',
        penulis='$_POST[penulis]',
        stok='$_POST[stok]'
        WHERE id_buku='$id'
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../assets/css/buku.css">
</head>
<body>

<div class="container">
    <h2>Edit Buku</h2>

    <div class="form-box">
        <form method="post">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= $buku['judul'] ?>" required>

            <label>Penulis</label>
            <input type="text" name="penulis" value="<?= $buku['penulis'] ?>" required>

            <label>Stok</label>
            <input type="number" name="stok" value="<?= $buku['stok'] ?>" required>

            <button type="submit" name="update" class="btn">Update</button>
            <br><br>
            <a href="index.php" class="btn">← Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
