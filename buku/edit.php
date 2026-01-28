<?php
include "../database/koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
$buku = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $stok    = $_POST['stok'];

    mysqli_query($koneksi,
        "UPDATE buku SET
         judul='$judul',
         penulis='$penulis',
         stok='$stok'
         WHERE id_buku='$id'"
    );

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Buku</title></head>
<body>

<h2>Edit Buku</h2>

<form method="post">
    <input type="text" name="judul" value="<?= $buku['judul'] ?>" required><br><br>
    <input type="text" name="penulis" value="<?= $buku['penulis'] ?>" required><br><br>
    <input type="number" name="stok" value="<?= $buku['stok'] ?>" required><br><br>
    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
