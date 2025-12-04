<?php 
include '../../config/session_check.php';
include '../../config/koneksi.php';

// Cek Role Admin 
if($_SESSION['role'] != 'admin'){
    header("Location: ../../login.php?pesan=denied");
    exit;
}
?>

<?php include 'layout_header.php'; ?>

<section class="content">
    <h1>Dashboard Overview</h1>
    <div class="dashboard-grid">
        <div class="stat-card blue">
            <h3>Selamat Datang</h3>
            <div class="number"><?= htmlspecialchars($_SESSION['username']); ?></div>
            <p>Admin Sistem</p>
        </div>
        <div class="stat-card green">
            <h3>Status Sistem</h3>
            <div class="number">ONLINE</div>
            <p>Siap melayani pesanan</p>
        </div>
    </div>
</section>

</div> 
</body>
</html>