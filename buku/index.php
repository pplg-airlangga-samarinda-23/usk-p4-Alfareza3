<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

/* =====================
   LOGIKA SEARCH & FILTER
===================== */
$where = [];

if (!empty($_GET['q'])) {
    $q = mysqli_real_escape_string($koneksi, $_GET['q']);
    $where[] = "(judul LIKE '%$q%' OR penulis LIKE '%$q%')";
}

if (!empty($_GET['kategori'])) {
    $kategori = mysqli_real_escape_string($koneksi, $_GET['kategori']);
    $where[] = "kategori = '$kategori'";
}

$sql = "SELECT * FROM buku";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY id_buku DESC";

$data = mysqli_query($koneksi, $sql);

// Ambil kategori unik untuk filter
$kategori_list = mysqli_query($koneksi, "
    SELECT DISTINCT kategori FROM buku WHERE kategori IS NOT NULL
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <link rel="stylesheet" href="../assets/css/buku.css">
</head>
<body>

<div class="container">
<h2>📚 Data Buku</h2>

<!-- TOMBOL TAMBAH -->
<a href="create.php" class="btn">+ Tambah Buku</a>
<br><br>

<!-- SEARCH & FILTER -->
<form method="get" class="filter-box">
    <input type="text" name="q" placeholder="Cari judul / penulis"
           value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">

    <select name="kategori">
        <option value="">-- Semua Kategori --</option>
        <?php while($k = mysqli_fetch_assoc($kategori_list)): ?>
            <option value="<?= $k['kategori']; ?>"
                <?= (isset($_GET['kategori']) && $_GET['kategori']==$k['kategori'])?'selected':'' ?>>
                <?= $k['kategori']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit" class="btn">Cari</button>
    <a href="index.php" class="btn btn-danger">Reset</a>
</form>

<!-- TABEL BUKU -->
<table class="table">
<tr>
    <th>No</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Tahun</th>
    <th>Kategori</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php if (mysqli_num_rows($data) == 0): ?>
<tr>
    <td colspan="7" style="text-align:center;">Data buku tidak ditemukan</td>
</tr>
<?php endif; ?>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['penulis'] ?></td>
    <td><?= $row['tahun_terbit'] ?></td>
    <td><?= $row['kategori'] ?></td>
    <td><?= $row['stok'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id_buku'] ?>" class="btn">Edit</a>
        <a href="delete.php?id=<?= $row['id_buku'] ?>"
           onclick="return confirm('Yakin hapus buku ini?')"
           class="btn btn-danger">
           Hapus
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="../dashboard.php" class="btn">← Dashboard</a>
</div>

</body>
</html>
