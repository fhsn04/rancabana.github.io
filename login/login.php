<?php 
include '../koneksi.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title>Login Pegawai</title>
</head>
<body>
    <div class="alert alert-warning" role="alert">
    </div>
 
    <div class="container">
        <form action="cek_login_p.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum Punya Akun? <a href="register.php">Daftar Akun </a></p>
            <a href="../index.php">Kembali Ke Halaman Utama </a></p>
        </form>
    </div>
</body>
</html>