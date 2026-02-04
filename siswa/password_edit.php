<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT * FROM akun_siswa WHERE id_akun='$id'
"));

if (isset($_POST['update'])) {
    mysqli_query($koneksi,"
        UPDATE akun_siswa 
        SET username='$_POST[username]'
        WHERE id_akun='$id'
    ");
    header("Location: password.php?id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Username</title>
    <link rel="stylesheet" href="../assets/css/siswa.css">
</head>
<body>

<div class="container">
<h2>✏️ Edit Username</h2>

<div class="form-box">
<form method="post">
    <label>Username</label>
    <input type="text" name="username" value="<?= $user['username'] ?>" required>

    <button type="submit" name="update" class="btn">Update</button>
    <br><br>
    <a href="password.php?id=<?= $id ?>" class="btn">← Kembali</a>
</form>
</div>
</div>

</body>
</html>
