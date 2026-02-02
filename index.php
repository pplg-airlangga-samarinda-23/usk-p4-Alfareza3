<?php
session_start();

// Jika sudah login
if (isset($_SESSION['login']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'admin') {
        header("Location: dashboard.php");
        exit;
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: user/dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Sekolah</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: #fff;
            padding: 30px;
            border: 2px solid #333;
            text-align: center;
            width: 350px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .btn {
            display: block;
            padding: 12px;
            margin: 10px 0;
            text-decoration: none;
            background: #4e73df;
            color: #fff;
            border-radius: 3px;
            font-weight: bold;
        }

        .btn:hover {
            background: #2e59d9;
        }

        .btn-user {
            background: #1cc88a;
        }

        .btn-user:hover {
            background: #17a673;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>📚 Perpustakaan Digital</h2>
    <p>Silakan pilih jenis login</p>

    <a href="login.php" class="btn">Login Admin</a>
    <a href="login_user.php" class="btn btn-user">Login User</a>
</div>

</body>
</html>
