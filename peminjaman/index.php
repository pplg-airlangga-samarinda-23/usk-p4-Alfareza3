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

// Search nama siswa
if (!empty($_GET['nama'])) {
    $nama = mysqli_real_escape_string($koneksi, $_GET['nama']);
    $where[] = "s.nama LIKE '%$nama%'";
}

// Filter kelas
if (!empty($_GET['kelas'])) {
    $kelas = mysqli_real_escape_string($koneksi, $_GET['kelas']);
    $where[] = "s.kelas = '$kelas'";
}

// Filter status
if (!empty($_GET['status'])) {
    $status = mysqli_real_escape_string($koneksi, $_GET['status']);
    $where[] = "p.status = '$status'";
}

// Filter tanggal pinjam
if (!empty($_GET['tgl'])) {
    $tgl = mysqli_real_escape_string($koneksi, $_GET['tgl']);
    $where[] = "DATE(p.tanggal_pinjam) = '$tgl'";
}

/* =====================
   QUERY DATA PEMINJAMAN
===================== */
$sql = "
    SELECT 
        p.id_peminjaman,
        s.nama,
        s.kelas,
        p.tanggal_pinjam,
        p.tanggal_kembali,
        p.status
    FROM peminjaman p
    JOIN siswa s ON p.id_siswa = s.id_siswa
";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY p.id_peminjaman DESC";

$data = mysqli_query($koneksi, $sql);

// Ambil daftar kelas unik
$kelas_list = mysqli_query($koneksi, "
    SELECT DISTINCT kelas FROM siswa WHERE kelas IS NOT NULL
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="../assets/css/peminjaman.css">
</head>
<body>

<div class="container">
<h2>🔄 Data Peminjaman</h2>

<a href="create.php" class="btn">+ Tambah Peminjaman</a>
<br><br>

<!-- SEARCH & FILTER -->
<form method="get" class="filter-box">
    <input type="text" name="nama" placeholder="Cari nama siswa"
           value="<?= isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : '' ?>">

    <select name="kelas">
        <option value="">-- Semua Kelas --</option>
        <?php while($k = mysqli_fetch_assoc($kelas_list)): ?>
            <option value="<?= $k['kelas']; ?>"
                <?= (isset($_GET['kelas']) && $_GET['kelas']==$k['kelas'])?'selected':'' ?>>
                <?= $k['kelas']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <select name="status">
        <option value="">-- Semua Status --</option>
        <option value="dipinjam" <?= (isset($_GET['status']) && $_GET['status']=='dipinjam')?'selected':'' ?>>
            Dipinjam
        </option>
        <option value="dikembalikan" <?= (isset($_GET['status']) && $_GET['status']=='dikembalikan')?'selected':'' ?>>
            Dikembalikan
        </option>
    </select>

    <input type="date" name="tgl"
           value="<?= isset($_GET['tgl']) ? $_GET['tgl'] : '' ?>">

    <button type="submit" class="btn">Cari</button>
    <a href="index.php" class="btn btn-danger">Reset</a>
</form>

<!-- TABEL PEMINJAMAN -->
<table class="table">
<tr>
    <th>No</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php if (mysqli_num_rows($data) == 0): ?>
<tr>
    <td colspan="7" style="text-align:center;">
        Data peminjaman tidak ditemukan
    </td>
</tr>
<?php endif; ?>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['kelas'] ?></td>
    <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal_pinjam'])) ?></td>
    <td>
        <?= $row['tanggal_kembali']
            ? date('d-m-Y H:i:s', strtotime($row['tanggal_kembali']))
            : '-' ?>
    </td>
    <td>
        <?php if($row['status']=='dipinjam'): ?>
            <span class="status-dipinjam">Dipinjam</span>
        <?php else: ?>
            <span class="status-kembali">Dikembalikan</span>
        <?php endif; ?>
    </td>
    <td>
        <?php if($row['status']=='dipinjam'): ?>
            <a href="kembali.php?id=<?= $row['id_peminjaman'] ?>"
               class="btn btn-success">
               Pengembalian
            </a>
        <?php endif; ?>

        <a href="edit.php?id=<?= $row['id_peminjaman'] ?>" class="btn">
            Edit
        </a>

        <a href="delete.php?id=<?= $row['id_peminjaman'] ?>"
           onclick="return confirm('Yakin hapus data peminjaman ini?')"
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
