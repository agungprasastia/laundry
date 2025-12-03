<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Laundry</title>
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>
<body class="login-page">

    <div class="login-box" style="max-width: 500px;">
        <h2 style="color: #007bff;">Cek Status Cucian</h2>
        
        <form action="cek_status.php" method="GET" style="margin-bottom: 20px;">
            <div class="input-group">
                <input type="number" name="id" placeholder="Masukkan ID Pesanan (Contoh: 1)" required 
                       value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            </div>
            <button type="submit" class="btn-full">Cari Pesanan</button>
        </form>

        <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn, "SELECT pesanan.*, paket.nama_paket 
                                          FROM pesanan 
                                          JOIN paket ON pesanan.id_paket = paket.id_paket 
                                          WHERE id_pesanan='$id'");
            
            if(mysqli_num_rows($query) > 0){
                $data = mysqli_fetch_array($query);
                
                // Tentukan warna badge status
                $warna = "gray";
                if($data['status'] == "Baru") $warna = "orange";
                else if($data['status'] == "Proses") $warna = "blue";
                else if($data['status'] == "Selesai") $warna = "green";
        ?>
                <div style="text-align: left; background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
                    <p><strong>Nama Pelanggan:</strong> <?php echo $data['nama_pelanggan']; ?></p>
                    <p><strong>Paket:</strong> <?php echo $data['nama_paket']; ?></p>
                    <p><strong>Tanggal Masuk:</strong> <?php echo $data['tanggal']; ?></p>
                    <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0;">
                    
                    <p><strong>Status:</strong> 
                        <span style="background: <?php echo $warna; ?>; color: white; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold;">
                            <?php echo $data['status']; ?>
                        </span>
                    </p>
                    
                    <?php if($data['total_bayar'] > 0) { ?>
                        <p style="font-size: 18px; margin-top: 10px; color: #28a745;">
                            <strong>Total: Rp <?php echo number_format($data['total_bayar']); ?></strong>
                        </p>
                    <?php } else { ?>
                        <p style="color: #777; font-size: 12px; margin-top: 10px;">*Total harga akan muncul setelah ditimbang oleh admin.</p>
                    <?php } ?>
                </div>
        <?php 
            } else {
                echo "<p style='color:red;'>Data pesanan tidak ditemukan.</p>";
            }
        }
        ?>
        
        <br>
        <a href="index.php" style="text-decoration: none; color: #555;">← Kembali ke Beranda</a>
    </div>

</body>
</html>