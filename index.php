<?php 
include 'config/koneksi.php';
include 'config/session_check.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Cepat & Bersih</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">Laundry Kinclong</div>
        <ul class="nav-links">

            <li><a href="index.php">Beranda</a></li>
            <li><a href="#paket">Paket</a></li>

            <?php 
            // Jika Pelanggan Login
            if(isset($_SESSION['status']) && $_SESSION['status'] == "login" && $_SESSION['role'] == "pelanggan"){
                echo '<li><a href="user/user_dashboard.php" style="color:#28a745; font-weight:bold;">Dashboard Saya</a></li>';
                echo '<li><a href="logout.php" class="btn-login" style="background:#dc3545;">Keluar</a></li>';

            // Jika Admin Login
            } else if(isset($_SESSION['status']) && $_SESSION['status'] == "login" && $_SESSION['role'] == "admin"){
                echo '<li><a href="admin/dashboard.php" style="color:#007bff; font-weight:bold;">Dashboard Admin</a></li>';

            // Belum Login
            } else {
                echo '<li><a href="login.php" class="btn-login">Login</a></li>';
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
        <p>Masukkan Nomor Pesanan (ID) untuk melihat status.</p>

        <form action="cek_status.php" method="GET" style="display:flex; gap:10px; justify-content:center; margin-top:15px;">
            <input type="number" name="id" placeholder="Contoh: 1" style="padding:10px; border:1px solid #ddd; width:200px;" required>
            <button type="submit" class="btn-small blue">Lacak</button>
        </form>
    </div>

    <section id="paket" class="container-public">
        <h2>Pilih Layanan Laundry</h2>

        <div class="card-grid">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM paket ORDER BY id_paket ASC");

            if(mysqli_num_rows($query) > 0){
                while($data = mysqli_fetch_assoc($query)){
            ?>
                <div class="card">

                    <?php if($data['foto'] != "") { ?>
                        <img src="assets/img/<?= $data['foto']; ?>" alt="<?= $data['nama_paket']; ?>">
                    <?php } else { ?>
                        <div class="card-img-placeholder">👕</div>
                    <?php } ?>

                    <div class="card-body">
                        <h3><?= $data['nama_paket']; ?></h3>
                        <p class="price">Rp <?= number_format($data['harga'], 0, ',', '.'); ?> / Kg</p>
                        <p class="desc">Estimasi: <strong><?= $data['estimasi']; ?></strong></p>
                        
                        <a href="user/pesan.php?id=<?= $data['id_paket']; ?>" class="btn-order">Pilih Layanan Ini</a>
                    </div>
                </div>
            <?php 
                }
            } else { 
                echo "<p style='width:100%; text-align:center; color:#777;'>Belum ada paket tersedia.</p>";
            } ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Laundry Kinclong. Tugas Besar Pemrograman Web.</p>
    </footer>

</body>
</html>
