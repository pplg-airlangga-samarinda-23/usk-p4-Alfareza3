<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include "../database/koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa='$id'");
header("Location: index.php");
