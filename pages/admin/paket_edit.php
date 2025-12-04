<?php 
include '../../config/koneksi.php';
include 'layout_header.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM paket WHERE id_paket='$id'");
$data = mysqli_fetch_array($query);
?>

<section class="content">
    <h1>Edit Paket Laundry</h1>

    <div class="form-container">
        <h3>Ubah Data Paket</h3>
        
        <form action="paket_update.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id_paket" value="<?= $data['id_paket']; ?>">

            <label>Nama Paket:</label>
            <input type="text" name="nama_paket" value="<?= $data['nama_paket']; ?>" required>

            <label>Harga (Rp):</label>
            <input type="number" name="harga" value="<?= $data['harga']; ?>" required>

            <label>Estimasi Waktu:</label>
            <input type="text" name="estimasi" value="<?= $data['estimasi']; ?>" required>

            <label>Gambar Saat Ini:</label><br>
            <img src="../../assets/img/<?= $data['foto']; ?>" width="120" style="border-radius:5px;"><br><br>

            <label>Ganti Gambar (Opsional):</label>
            <input type="file" name="foto">
            <small style="color:red;">Format: JPG/PNG/JPEG/GIF</small>

            <div class="add-button">
                <button type="submit">Simpan Perubahan</button>
                <a href="paket.php" class="btn-small red" style="text-decoration:none;">Batal</a>
            </div>
        </form>
    </div>
</section>

</div>
</body>
</html>