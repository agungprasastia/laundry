<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

if($_SESSION['role'] != "pelanggan"){ header("location:../login.php"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Laundry Baru</title>
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>
<body class="login-page">

    <div class="login-box" style="text-align: left; max-width: 500px;">
        <h2 style="text-align: center; color:#007bff; margin-bottom: 20px;">👕 Order Laundry</h2>
        
        <form action="proses_pesan_user.php" method="POST">
            <input type="hidden" name="id_pelanggan" value="<?php echo $_SESSION['id_pelanggan']; ?>">
            <input type="hidden" name="nama_pelanggan" value="<?php echo $_SESSION['nama_pelanggan']; ?>">

            <div class="input-group">
                <label>Pilih Paket Laundry:</label>
                <select name="id_paket" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                    <option value="">-- Pilih Paket --</option>
                    <?php 
                    $paket = mysqli_query($conn, "SELECT * FROM paket");
                    while($p = mysqli_fetch_array($paket)){
                        echo "<option value='".$p['id_paket']."'>".$p['nama_paket']." - Rp ".number_format($p['harga'])."/Kg</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-group">
                <label>Tanggal Masuk:</label>
                <input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>

            <div class="input-group">
                <label>Catatan Tambahan (Opsional):</label>
                <input type="text" name="catatan" placeholder="Contoh: Jangan disetrika panas">
            </div>

            <button type="submit" class="btn-full" style="background-color: #28a745;">Kirim Pesanan</button>
            <a href="user_dashboard.php" style="display:block; text-align:center; margin-top:15px; color:#666; text-decoration:none;">Batal</a>
        </form>
    </div>

</body>
</html>