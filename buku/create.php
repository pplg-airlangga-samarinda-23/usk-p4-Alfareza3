<?php
include "../database/koneksi.php";

if (isset($_POST['simpan'])) {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $stok    = $_POST['stok'];

    mysqli_query($koneksi,
        "INSERT INTO buku (judul, penulis, stok)
         VALUES ('$judul','$penulis','$stok')"
    );

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Tambah Buku</title></head>
<body>

<h2>Tambah Buku</h2>

<form method="post">
    <label>Judul</label><br>
    <input type="text" name="judul" required><br><br>

    <label>Penulis</label><br>
    <input type="text" name="penulis" required><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

</body>
</html>
