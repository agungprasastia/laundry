<?php 
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Status Laundry</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="login-page">

<div class="login-box" style="max-width: 500px;">
    <h2 style="color: #007bff;">Cek Status Cucian</h2>

    <form action="cek_status.php" method="GET" style="margin-bottom: 20px;">
        <input type="number" name="id" placeholder="Masukkan ID Pesanan" required 
               value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
        <button type="submit" class="btn-full">Cari Pesanan</button>
    </form>

<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = mysqli_query($conn, "
        SELECT pesanan.*, paket.nama_paket 
        FROM pesanan 
        JOIN paket ON pesanan.id_paket = paket.id_paket 
        WHERE id_pesanan='$id'
    ");

    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);
?>
    <div style="background:#f9f9f9; padding:20px; border-radius:8px; border:1px solid #ddd;">
        <p><strong>Nama Pelanggan:</strong> <?= $data['nama_pelanggan'] ?></p>
        <p><strong>Paket:</strong> <?= $data['nama_paket'] ?></p>
        <p><strong>Tanggal Masuk:</strong> <?= $data['tanggal'] ?></p>
        <p><strong>Status:</strong> <?= $data['status'] ?></p>
        <p><strong>Total Bayar:</strong> Rp <?= number_format($data['total_bayar']) ?></p>
    </div>
<?php 
    } else {
        echo "<p style='color:red;'>Data pesanan tidak ditemukan.</p>";
    }
}
?>

    <br>

    <a href="../../index.php">← Kembali ke Beranda</a>
</div>

</body>
</html>
