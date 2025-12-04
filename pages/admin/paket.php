<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';
include 'layout_header.php';
?>

<section class="content">
    <h1>Kelola Paket Laundry</h1>
    
    <div class="form-container">
        <h3>Tambah Paket Baru</h3>
        <form action="paket_tambah.php" method="POST" enctype="multipart/form-data">
            <label>Nama Paket:</label>
            <input type="text" name="nama_paket" required placeholder="Contoh: Cuci Kiloan">
            
            <label>Harga (Rp):</label>
            <input type="number" name="harga" required placeholder="7000">
            
            <label>Estimasi Waktu:</label>
            <input type="text" name="estimasi" required placeholder="2 Hari">
            
            <label>Gambar:</label>
            <input type="file" name="foto" required>
            
            <div class="add-button">
                <button type="submit">Simpan Paket</button>
            </div>
        </form>
    </div>

    <h3>Daftar Paket</h3>
    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <thead>
            <tr style="background:#007bff; color:white;">
                <th style="padding:10px;">No</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Estimasi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $data = mysqli_query($conn, "SELECT * FROM paket");
            while($d = mysqli_fetch_array($data)){
            ?>
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;"><?= $no++; ?></td>
                <td><?= $d['nama_paket']; ?></td>
                <td>Rp <?= number_format($d['harga']); ?></td>
                <td><?= $d['estimasi']; ?></td>
                <td>
                    <img src="../../assets/img/<?= $d['foto']; ?>" width="80" style="border-radius:5px;">
                </td>
                <td>
                    <a href="paket_edit.php?id=<?= $d['id_paket']; ?>" class="btn-small blue">Edit</a>
                    <a href="paket_hapus.php?id=<?= $d['id_paket']; ?>&foto=<?= $d['foto']; ?>" 
                       class="btn-small red" 
                       onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

</div>
</body>
</html>