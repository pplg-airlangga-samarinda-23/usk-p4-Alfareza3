<?php
session_start();
include "database/koneksi.php";

// Ambil siswa yang BELUM punya akun
$siswa = mysqli_query($koneksi, "
    SELECT * FROM siswa 
    WHERE id_siswa NOT IN (SELECT id_siswa FROM akun_siswa)
");

if (isset($_POST['daftar'])) {

    $id_siswa = $_POST['id_siswa'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi kosong
    if ($id_siswa == "" || $username == "" || $password == "") {
        $error = "Semua field wajib diisi!";
    } else {
        // Cek username
        $cek = mysqli_query($koneksi, "
            SELECT * FROM akun_siswa WHERE username='$username'
        ");

        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Simpan akun
            mysqli_query($koneksi, "
                INSERT INTO akun_siswa (id_siswa, username, password)
                VALUES ('$id_siswa', '$username', '$password')
            ");

            echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location='login_user.php';
            </script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi User</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="login-box">
    <h2>Registrasi User</h2>

    <?php if (isset($error)): ?>
        <p style="color:red; text-align:center;">
            <?= $error ?>
        </p>
    <?php endif; ?>

    <form method="post">

        <label>Nama Siswa</label>
        <select name="id_siswa" required>
            <option value="">-- Pilih Siswa --</option>
            <?php while($s = mysqli_fetch_assoc($siswa)): ?>
                <option value="<?= $s['id_siswa']; ?>">
                    <?= $s['nama']; ?> (<?= $s['kelas']; ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="daftar">Daftar</button>
    </form>
    <br>
    <!-- TOMBOL KEMBALI -->
    <a href="login_user.php">
        <button type="button">← Kembali</button>
    </a>

    <div class="footer-text">
        © Perpustakaan Sekolah Digital
    </div>
</div>

</body>
</html>
