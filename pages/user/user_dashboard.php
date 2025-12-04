<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'pelanggan'){
    echo "<script>alert('Akses ditolak!'); window.location='../../login.php';</script>";
    exit();
}
$id_saya = $_SESSION['id_pelanggan'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">Laundry Kinclong</div>
        <ul class="nav-links">
            <li><a href="../../index.php">Beranda</a></li>
            <li><a href="user_dashboard.php" style="font-weight:bold; color: #007bff;">Dashboard</a></li>
            <li><a href="../../logout.php" class="btn-login" style="background-color: #dc3545;">Keluar</a></li>
        </ul>
    </nav>

    <div class="container-public">
        <div class="welcome-banner">
            <div>
                <h2 style="margin:0;">Halo, <?php echo $_SESSION['nama_pelanggan']; ?>! 👋</h2>
                <p style="margin:5px 0 0 0; opacity:0.9;">Mau nyuci apa hari ini?</p>
            </div>
            <a href="user_pesan.php" class="btn-order-big">➕ Buat Pesanan Baru</a>
        </div>

        <h3 style="border-left: 5px solid #007bff; padding-left: 15px; color: #444;">📦 Riwayat & Status Cucian</h3>
        
        <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; margin-top: 20px;">
            <thead style="background-color: #343a40; color: white;">
                <tr>
                    <th style="padding: 15px;">Tanggal</th>
                    <th>Paket Laundry</th>
                    <th>Berat/Total</th>
                    <th>Status Cucian</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = mysqli_query($conn, "SELECT pesanan.*, paket.nama_paket 
                                              FROM pesanan 
                                              JOIN paket ON pesanan.id_paket = paket.id_paket 
                                              WHERE id_pelanggan='$id_saya' 
                                              ORDER BY id_pesanan DESC");
                
                if(mysqli_num_rows($query) > 0){
                    while($d = mysqli_fetch_array($query)){
                        $st_cuci = "bg-orange";
                        if($d['status']=="Proses") $st_cuci="bg-blue";
                        if($d['status']=="Selesai") $st_cuci="bg-green";

                        $st_bayar = "bg-red";
                        if($d['status_bayar']=="Menunggu Verifikasi") $st_bayar="bg-orange";
                        if($d['status_bayar']=="Lunas") $st_bayar="bg-green";
                ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;"><?php echo date('d M Y', strtotime($d['tanggal'])); ?></td>
                    <td><strong><?php echo $d['nama_paket']; ?></strong></td>
                    <td>
                        <?php 
                        if($d['berat'] > 0){
                            echo $d['berat']." Kg<br><small style='color:green;'>Rp ".number_format($d['total_bayar'])."</small>";
                        } else {
                            echo "<small style='color:#777;'>Menunggu Timbang</small>";
                        }
                        ?>
                    </td>
                    <td><span class="status-badge <?php echo $st_cuci; ?>"><?php echo $d['status']; ?></span></td>
                    <td><span class="status-badge <?php echo $st_bayar; ?>"><?php echo $d['status_bayar']; ?></span></td>
                    <td>
                        <?php if($d['status_bayar'] == "Belum Lunas" && $d['total_bayar'] > 0){ ?>
                            <a href="user_bayar.php?id=<?php echo $d['id_pesanan']; ?>" class="btn-small blue">Bayar</a>
                        <?php } elseif($d['status_bayar'] == "Menunggu Verifikasi") { ?>
                            <small style="color:#fd7e14;">Cek Admin...</small>
                        <?php } elseif($d['status_bayar'] == "Lunas") { ?>
                            <small style="color:green;">✔ Selesai</small>
                        <?php } else { ?>
                            <small style="color:#ccc;">-</small>
                        <?php } ?>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Belum ada pesanan. Yuk pesan sekarang!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>