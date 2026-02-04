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
    $where[] = "(nama LIKE '%$q%' OR nis LIKE '%$q%')";
}

if (!empty($_GET['kelas'])) {
    $kelas = mysqli_real_escape_string($koneksi, $_GET['kelas']);
    $where[] = "kelas = '$kelas'";
}

$sql = "
    SELECT s.*, a.id_akun
    FROM siswa s
    LEFT JOIN akun_siswa a ON s.id_siswa = a.id_siswa
";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY s.id_siswa DESC";


$data = mysqli_query($koneksi, $sql);

// Ambil kelas unik untuk filter
$kelas_list = mysqli_query($koneksi, "
    SELECT DISTINCT kelas FROM siswa WHERE kelas IS NOT NULL
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="../assets/css/siswa.css">
</head>
<body>

<div class="container">
<h2>👨‍🎓 Data Siswa</h2>

<!-- TOMBOL TAMBAH -->
<a href="create.php" class="btn">+ Tambah Siswa</a>
<br><br>

<!-- SEARCH & FILTER -->
<form method="get" class="filter-box">
    <input type="text" name="q" placeholder="Cari nama / NIS"
           value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">

    <select name="kelas">
        <option value="">-- Semua Kelas --</option>
        <?php while($k = mysqli_fetch_assoc($kelas_list)): ?>
            <option value="<?= $k['kelas']; ?>"
                <?= (isset($_GET['kelas']) && $_GET['kelas']==$k['kelas'])?'selected':'' ?>>
                <?= $k['kelas']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit" class="btn">Cari</button>
    <a href="index.php" class="btn btn-danger">Reset</a>
</form>

<!-- TABEL SISWA -->
<table class="table">
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>No HP</th>
    <th>Aksi</th>
</tr>

<?php if (mysqli_num_rows($data) == 0): ?>
<tr>
    <td colspan="6" style="text-align:center;">Data siswa tidak ditemukan</td>
</tr>
<?php endif; ?>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nis'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['kelas'] ?></td>
    <td><?= $row['no_hp'] ?></td>
<td>
    <a href="edit.php?id=<?= $row['id_siswa'] ?>" class="btn">Edit</a>

    <?php if ($row['id_akun']): ?>
        <a href="password.php?id=<?= $row['id_akun'] ?>" class="btn btn-success">
            Password
        </a>
    <?php else: ?>
        <span style="color:#888;">Belum ada akun</span>
    <?php endif; ?>

    <a href="delete.php?id=<?= $row['id_siswa'] ?>"
       onclick="return confirm('Yakin hapus siswa ini?')"
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
