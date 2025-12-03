<?php 
include 'config/koneksi.php';
include 'config/session_check.php';  // jika diperlukan 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laundry Kinclong</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">

    <div class="login-box">
        <h2>Masuk Aplikasi</h2>
        <p>Silakan login untuk melanjutkan</p>
        
        <?php 
        if(isset($_GET['pesan'])){
            if($_GET['pesan'] == "gagal"){
                echo "<div style='color:red; margin-bottom:10px;'>Username atau Password salah!</div>";
            } 
            else if($_GET['pesan'] == "logout"){
                echo "<div style='color:green; margin-bottom:10px;'>Anda berhasil logout.</div>";
            } 
            else if($_GET['pesan'] == "belum_login"){
                echo "<div style='color:orange; margin-bottom:10px;'>Silakan login dulu.</div>";
            }
        }
        ?>
        
        <form action="config/cek_login.php" method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Masukkan username">
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn-full">Masuk</button>
        </form>
        
        <p style="margin-top: 10px; font-size: 14px;">
            <a href="index.php" style="color:#666; text-decoration:none;">← Kembali ke Beranda</a>
        </p>
    </div>

</body>
</html>
