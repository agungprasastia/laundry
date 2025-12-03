<?php 
session_start();
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laundry Cepat & Bersih</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Laundry Kinclong</div>

    <ul class="nav-links">
        <li><a href="/index.php">Beranda</a></li>
        <li><a href="#paket">Paket</a></li>

        <?php 
        if(isset($_SESSION['status']) && $_SESSION['status']=="login"){
            if($_SESSION['role']=="pelanggan"){
                echo '<li><a href="/pages/user/user_dashboard.php" style="color:#28a745;">Dashboard Saya</a></li>';
                echo '<li><a href="/logout.php" class="btn-login" style="background:red;">Keluar</a></li>';
            } else {
                echo '<li><a href="/pages/admin/dashboard.php" style="color:#007bff;">Dashboard Admin</a></li>';
            }
        } else {
            echo '<li><a href="/login.php" class="btn-login">Login</a></li>';
        }
        ?>
    </ul>
</nav>

<header class="hero">
    <h1>Solusi Pakaian Bersih Tanpa Ribet</h1>
    <p>Pesan online, kami jemput, cuci, dan antar kembali.</p>
    <a href="#paket" class="cta-button">Lihat Paket</a>
</header>

<div class="track-box">
    <h3>Lacak Cucian Anda</h3>

    <form action="/pages/user/cek_status.php" method="GET">
        <input type="number" name="id" required placeholder="Masukkan ID Pesanan">
        <button type="submit" class="btn-small blue">Lacak</button>
    </form>
</div>

<section id="paket" class="container-public">
    <h2>Pilih Layanan Laundry</h2>

    <div class="card-grid">
        <?php
        $q = mysqli_query($conn, "SELECT * FROM paket ORDER BY id_paket ASC");
        while($row = mysqli_fetch_assoc($q)){
        ?>
        <div class="card">
            <img src="/assets/img/<?= $row['foto'] ?>">
            <div class="card-body">
                <h3><?= $row['nama_paket'] ?></h3>
                <p class="price">Rp <?= number_format($row['harga']) ?> / Kg</p>
                <p>Estimasi: <?= $row['estimasi'] ?></p>
                <a href="/pages/user/pesan.php?id=<?= $row['id_paket'] ?>"></a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<footer>
    <p>&copy; 2025 Laundry Kinclong</p>
</footer>

</body>
</html>
