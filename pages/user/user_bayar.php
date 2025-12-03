<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

// Halaman ini hanya boleh diakses pelanggan
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'pelanggan'){
    echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
    exit();
}

$q = mysqli_query($conn, "SELECT total_bayar FROM pesanan WHERE id_pesanan='$id_pesanan'");
$d = mysqli_fetch_array($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Laundry</title>
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>
<body class="login-page">

    <div class="login-box">
        <h2 style="color:#28a745;">Pembayaran</h2>
        <p>Silakan transfer sesuai nominal di bawah:</p>
        
        <h1 style="margin: 10px 0; color:#333;">Rp <?php echo number_format($d['total_bayar']); ?></h1>
        
        <div style="background:#f8f9fa; padding:10px; border-radius:5px; margin-bottom:20px; border:1px dashed #ccc;">
            <strong>Bank BCA: 123-456-7890</strong><br>
            A.n Laundry Kinclong
        </div>

        <form action="proses_bayar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_pesanan" value="<?php echo $id_pesanan; ?>">
            
            <div class="input-group">
                <label>Upload Bukti Transfer:</label>
                <input type="file" name="bukti" required accept="image/*">
            </div>

            <button type="submit" class="btn-full" style="background-color: #007bff;">Kirim Bukti Bayar</button>
            <a href="user_dashboard.php" style="display:block; text-align:center; margin-top:15px; color:#666;">Batal</a>
        </form>
    </div>

</body>
</html>