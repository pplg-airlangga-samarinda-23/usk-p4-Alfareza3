<?php
include "../database/koneksi.php";

$id = $_GET['id'];

// 1. Cek apakah buku masih dipakai di peminjaman
$cek = mysqli_query($koneksi, "
    SELECT * FROM detail_peminjaman 
    WHERE id_buku='$id'
");

if (mysqli_num_rows($cek) > 0) {
    // 2. Jika masih dipinjam / pernah dipinjam
    echo "<script>
        alert('Buku tidak dapat dihapus karena masih atau pernah digunakan dalam transaksi peminjaman!');
        window.location='index.php';
    </script>";
    exit;
}

// 3. Jika aman, hapus buku
mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");

echo "<script>
    alert('Buku berhasil dihapus.');
    window.location='index.php';
</script>";
