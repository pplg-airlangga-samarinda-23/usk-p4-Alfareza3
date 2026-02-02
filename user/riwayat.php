<?php
include "auth.php";
include "../database/koneksi.php";

$id_siswa = $_SESSION['id_siswa'];

/* =====================
   SEARCH & FILTER
===================== */
$where = [];

if (!empty($_GET['judul'])) {
    $judul = mysqli_real_escape_string($koneksi, $_GET['judul']);
    $where[] = "b.judul LIKE '%$judul%'";
}

if (!empty($_GET['status'])) {
    $status = mysqli_real_escape_string($koneksi, $_GET['status']);
    $where[] = "p.status = '$status'";
}

$sql = "
    SELECT 
        p.id_peminjaman,
        p.tanggal_pinjam,
        p.tanggal_kembali,
        p.status,
        b.judul,
        d.jumlah
    FROM peminjaman p
    JOIN detail_peminjaman d ON p.id_peminjaman = d.id_peminjaman
    JOIN buku b ON d.id_buku = b.id_buku
    WHERE p.id_siswa = '$id_siswa'
";

if ($where) {
    $sql .= " AND " . implode(" AND ", $where);
}

$sql .= " ORDER BY p.id_peminjaman DESC";

$data = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>📄 Riwayat Peminjaman Saya</h2>

<!-- SEARCH & FILTER -->
<form method="get" class="filter-box">
    <input type="text" name="judul" placeholder="Cari judul buku"
           value="<?= isset($_GET['judul']) ? htmlspecialchars($_GET['judul']) : '' ?>">

    <select name="status">
        <option value="">-- Semua Status --</option>
        <option value="dipinjam" <?= (isset($_GET['status']) && $_GET['status']=='dipinjam')?'selected':'' ?>>
            Dipinjam
        </option>
        <option value="dikembalikan" <?= (isset($_GET['status']) && $_GET['status']=='dikembalikan')?'selected':'' ?>>
            Dikembalikan
        </option>
    </select>

    <button type="submit" class="btn">Cari</button>
    <a href="riwayat.php" class="btn btn-danger">Reset</a>
</form>

<!-- TABEL RIWAYAT -->
<table class="table">
<tr>
    <th>No</th>
    <th>Judul Buku</th>
    <th>Jumlah</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
</tr>

<?php if (mysqli_num_rows($data) == 0): ?>
<tr>
    <td colspan="6" style="text-align:center;">
        Riwayat peminjaman belum ada
    </td>
</tr>
<?php endif; ?>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['jumlah'] ?></td>
    <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal_pinjam'])) ?></td>
    <td>
        <?= $row['tanggal_kembali']
            ? date('d-m-Y H:i:s', strtotime($row['tanggal_kembali']))
            : '-' ?>
    </td>
    <td>
        <?php if ($row['status']=='dipinjam'): ?>
            <span class="status-dipinjam">Dipinjam</span>
        <?php else: ?>
            <span class="status-kembali">Dikembalikan</span>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="dashboard.php" class="btn">← Dashboard</a>
</div>

</body>
</html>
