<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';
include 'layout_header.php'; 
?>

<section class="content">
    <h1>Data Pesanan Masuk</h1>
    
    <table style="width: 100%; border-collapse: collapse; background: white;">
        <thead>
            <tr style="background-color: #007bff; color: white;">
                <th>No</th>
                <th>Pelanggan</th>
                <th>Paket</th>
                <th>Berat (Kg)</th>
                <th>Total Bayar</th>
                <th>Status Cucian</th>
                <th>Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        $no = 1;

        $query = mysqli_query($conn, 
        "SELECT pesanan.*, paket.nama_paket, paket.harga 
         FROM pesanan 
         JOIN paket ON pesanan.id_paket = paket.id_paket 
         ORDER BY id_pesanan DESC");

        while($d = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <form action="pesanan_update.php" method="POST">
                <td><?= $no++; ?></td>
                <td><?= $d['nama_pelanggan']; ?></td>
                <td><?= $d['nama_paket']; ?></td>

                <input type="hidden" name="id" value="<?= $d['id_pesanan']; ?>">
                <input type="hidden" name="harga_per_kg" value="<?= $d['harga']; ?>">

                <td><input type="number" name="berat" value="<?= $d['berat']; ?>" step="0.1" style="width:60px;"></td>

                <td>Rp <?= number_format($d['total_bayar']); ?></td>

                <td>
                    <select name="status" style="padding:3px;">
                        <option value="Baru"     <?= $d['status']=="Baru"?'selected':''; ?>>Baru</option>
                        <option value="Proses"   <?= $d['status']=="Proses"?'selected':''; ?>>Proses</option>
                        <option value="Selesai"  <?= $d['status']=="Selesai"?'selected':''; ?>>Selesai</option>
                        <option value="Diambil"  <?= $d['status']=="Diambil"?'selected':''; ?>>Diambil</option>
                    </select>
                </td>

                <td>
                    <select name="status_bayar" style="padding:3px;">
                        <option value="Belum Lunas"         <?= $d['status_bayar']=="Belum Lunas"?'selected':''; ?>>Belum Lunas</option>
                        <option value="Menunggu Verifikasi" <?= $d['status_bayar']=="Menunggu Verifikasi"?'selected':''; ?>>Menunggu Verifikasi</option>
                        <option value="Lunas"               <?= $d['status_bayar']=="Lunas"?'selected':''; ?>>Lunas</option>
                    </select>

                    <?php if($d['bukti_bayar']!=""){ ?>
                        <br>
                        <a href="../../assets/img/<?= $d['bukti_bayar']; ?>" target="_blank" style="font-size:11px;color:blue;">
                            Lihat Bukti
                        </a>
                    <?php } ?>
                </td>

                <td>
                    <button type="submit" class="btn-small blue">Update</button>
                    <a href="pesanan_hapus.php?id=<?= $d['id_pesanan']; ?>" 
                       onclick="return confirm('Hapus pesanan ini?')" 
                       class="btn-small red">Hapus</a>
                </td>
                </form>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</section>
