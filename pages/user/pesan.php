<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';
$id_paket = isset($_GET['id']) ? $_GET['id'] : '';

$q_paket = mysqli_query($conn, "SELECT * FROM paket WHERE id_paket='$id_paket'");
$d_paket = mysqli_fetch_array($q_paket);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan</title>
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>
<body class="login-page"> <div class="login-box" style="text-align: left;">
        <h2 style="text-align: center; color:#28a745;">📝 Form Order</h2>
        <p style="text-align: center; margin-bottom: 20px;">Lengkapi data untuk memesan layanan.</p>

        <?php if($id_paket != "" && mysqli_num_rows($q_paket) > 0) { ?>
            
            <div style="background: #f1f8ff; padding: 10px; border-radius: 5px; margin-bottom: 20px; border-left: 4px solid #007bff;">
                <small>Paket yang dipilih:</small><br>
                <strong><?php echo $d_paket['nama_paket']; ?></strong><br>
                <small>Harga: Rp <?php echo number_format($d_paket['harga']); ?></small>
            </div>

            <form action="pesan_simpan.php" method="POST">
                <input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>">

                <div class="input-group">
                    <label>Nama Anda (Pelanggan)</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="input-group">
                    <label>Tanggal Order</label>
                    <input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>

                <button type="submit" class="btn-full" style="background-color: #28a745;">Buat Pesanan</button>
                <a href="../index.php" style="display:block; text-align:center; margin-top:15px; text-decoration:none; color:#666;">Batal</a>
            </form>

        <?php } else { ?>
            <p style="text-align:center; color:red;">Paket tidak ditemukan!</p>
            <a href="../index.php" class="btn-full">Kembali ke Beranda</a>
        <?php } ?>
    </div>

</body>
</html>