<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';
include 'layout_header.php'; 

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    echo "<script>alert('Akses ditolak!'); window.location='../../login.php';</script>";
    exit();
}
?>

<section class="content">
    <h1>Laporan Keuangan</h1>
    
    <?php
    $tgl_mulai   = date('Y-m-01');
    $tgl_selesai = date('Y-m-d');

    if(isset($_GET['tgl_mulai']) && !empty($_GET['tgl_mulai']) && isset($_GET['tgl_selesai']) && !empty($_GET['tgl_selesai'])){
        $tgl_mulai   = $_GET['tgl_mulai'];
        $tgl_selesai = $_GET['tgl_selesai'];
    }
    ?>

    <div class="form-container">
        <label>Filter Laporan:</label>
        
        <form method="GET" action="" style="display: flex; gap: 10px; align-items: flex-end;">
            <div>
                <label style="font-size:12px; margin-bottom:2px;">Dari Tanggal</label>
                <input type="date" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>" required>
            </div>
            <div style="align-self: center; padding-bottom: 15px;">s/d</div>
            <div>
                <label style="font-size:12px; margin-bottom:2px;">Sampai Tanggal</label>
                <input type="date" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>" required>
            </div>
            <div style="padding-bottom: 15px;">
                <button type="submit" class="btn-small blue" style="height: 42px;">Tampilkan</button>
                <a href="laporan.php" class="btn-small red" style="height: 42px; display:inline-flex; align-items:center; text-decoration:none;">Reset</a>
            </div>
        </form>
    </div>

    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #007bff; color: white;">
                <th style="padding: 10px; border: 1px solid #ddd;">No</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Tanggal</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Pelanggan</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Paket Laundry</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Berat (Kg)</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_pemasukan = 0;
            $no = 1;

            $query = mysqli_query($conn, "SELECT pesanan.*, paket.nama_paket 
                                          FROM pesanan 
                                          JOIN paket ON pesanan.id_paket = paket.id_paket
                                          WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
                                          ORDER BY tanggal ASC");

            while($d = mysqli_fetch_array($query)){
                // Hanya hitung yang 'Lunas' (Opsional)
                if($d['status_bayar'] == 'Lunas') {
                    $total_pemasukan += $d['total_bayar'];
                }
            ?>
            <tr>
                <td style="text-align:center; border: 1px solid #eee; padding: 10px;"><?php echo $no++; ?></td>
                <td style="border: 1px solid #eee; padding: 10px;"><?php echo date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                <td style="border: 1px solid #eee; padding: 10px;"><?php echo $d['nama_pelanggan']; ?></td>
                <td style="border: 1px solid #eee; padding: 10px;"><?php echo $d['nama_paket']; ?></td>
                <td style="text-align:center; border: 1px solid #eee; padding: 10px;"><?php echo $d['berat']; ?></td>
                <td style="text-align:right; border: 1px solid #eee; padding: 10px;">
                    <?php echo "Rp " . number_format($d['total_bayar'], 0, ',', '.'); ?>
                    <?php if($d['status_bayar'] != 'Lunas') echo "<br><small style='color:red;'>(Belum Lunas)</small>"; ?>
                </td>
            </tr>
            <?php } ?>

            <?php if(mysqli_num_rows($query) == 0){ ?>
                <tr>
                    <td style="text-align:center; padding: 20px; color: #777; border: 1px solid #eee;">
                        Tidak ada data transaksi pada periode <b><?php echo $tgl_mulai; ?></b> s/d <b><?php echo $tgl_selesai; ?></b>.
                    </td>
                </tr>
            <?php } ?>

            <tr style="background-color: #f8f9fa; font-weight: bold;">
                <td colspan="5" style="text-align: right; padding: 15px; border: 1px solid #eee;">TOTAL PENDAPATAN (LUNAS)</td>
                <td style="text-align: right; padding: 15px; color: #28a745; font-size: 16px; border: 1px solid #eee;">
                    Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <div style="text-align: right;">
        <button onclick="window.print()" class="btn-small blue">Cetak Laporan</button>
    </div>
</section>

</div>
</body>
</html>