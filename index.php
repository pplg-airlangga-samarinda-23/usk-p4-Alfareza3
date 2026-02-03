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
    :root {
        --primary-color: #4e73df;
        --light-bg: linear-gradient(135deg, #4e73df, #1cc88a);
        --dark-text: #333;
        --border-radius: 10px;
        --shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        --transition: all 0.3s ease;
    }

    * {
        box-sizing: border-box;
        font-family: "Segoe UI", Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
    }

    body {
        background: var(--light-bg);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box {
        background: #ffffff;
        width: 100%;
        max-width: 380px;
        padding: 2.5rem;
        border-radius: var(--border-radius);
        text-align: center;
        box-shadow: var(--shadow);
    }

    .box h2 {
        margin-bottom: 10px;
        color: var(--dark-text);
        font-size: 1.8rem;
        font-weight: 600;
    }

    .box p {
        margin-bottom: 25px;
        font-size: 0.9rem;
        color: #64748b;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 0.75rem;
        margin-bottom: 12px;
        text-decoration: none;
        background: var(--primary-color);
        color: #fff;
        border-radius: var(--border-radius);
        font-weight: 600;
        transition: var(--transition);
    }

    .btn:hover {
        background: #2e59d9;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .btn-user {
        background: #1cc88a;
    }

    .btn-user:hover {
        background: #17a673;
    }

    .footer {
        margin-top: 18px;
        font-size: 0.8rem;
        color: #777;
    }

    /* RESPONSIVE */
    @media (max-width: 480px) {
        .box {
            margin: 1rem;
            padding: 2rem;
        }
    }
</style>

</head>
<body>

<div class="box">
    <h2>📚 Perpustakaan Sekolah</h2>
    <p>Sistem Informasi Perpustakaan Sekolah</p>

    <a href="login.php" class="btn">Login Admin</a>
    <a href="login_user.php" class="btn btn-user">Login User</a>

    <div class="footer">
        © <?php echo date('Y'); ?> Perpustakaan Sekolah
    </div>
</div>

</body>
</html>
