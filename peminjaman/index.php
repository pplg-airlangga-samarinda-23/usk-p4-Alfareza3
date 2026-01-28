<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$data = mysqli_query($koneksi, "
    SELECT 
        p.id_peminjaman,
        s.nama AS nama_siswa,
        p.tanggal_pinjam,
        p.tanggal_kembali,
        p.status
    FROM peminjaman p
    JOIN siswa s ON p.id_siswa = s.id_siswa
    ORDER BY p.id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
</head>
<body>

<h2>📚 Data Peminjaman Buku</h2>

<a href="create.php">+ Tambah Peminjaman</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Tanggal & Jam Pinjam</th>
        <th>Tanggal & Jam Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (mysqli_num_rows($data) > 0): ?>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_siswa'] ?></td>

            <!-- Tanggal Pinjam -->
            <td>
                <?= date('d-m-Y H:i:s', strtotime($row['tanggal_pinjam'])) ?>
            </td>

            <!-- Tanggal Kembali -->
            <td>
                <?= $row['tanggal_kembali'] 
                    ? date('d-m-Y H:i:s', strtotime($row['tanggal_kembali'])) 
                    : '-' ?>
            </td>

            <!-- Status -->
            <td>
                <?php if ($row['status'] == 'dipinjam'): ?>
                    <span style="color:red;font-weight:bold;">Dipinjam</span>
                <?php else: ?>
                    <span style="color:green;font-weight:bold;">Dikembalikan</span>
                <?php endif; ?>
            </td>

            <!-- Aksi -->
            <td>
                <?php if ($row['status'] == 'dipinjam'): ?>
                    <a href="kembali.php?id=<?= $row['id_peminjaman'] ?>">
                        Pengembalian
                    </a>
                <?php else: ?>
                    Selesai
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" align="center">
                Belum ada data peminjaman
            </td>
        </tr>
    <?php endif; ?>
</table>

<br>
<a href="../dashboard.php">← Kembali ke Dashboard</a>

</body>
<?php if (isset($_SESSION['alert'])): ?>

<script>
switch ("<?= $_SESSION['alert']; ?>") {

    case "berhasil":
        alert("✅ Buku berhasil dikembalikan!");
        break;

    case "sudah_dikembalikan":
        alert("⚠️ Buku ini sudah pernah dikembalikan!");
        break;

    case "gagal":
        alert("❌ Pengembalian gagal. Silakan coba lagi.");
        break;

    default:
        alert("⚠️ Terjadi kesalahan.");
}
</script>
<?php unset($_SESSION['alert']); endif; ?>
</html>
