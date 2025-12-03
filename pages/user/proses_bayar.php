<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$id = $_POST['id_pesanan'];

// Upload Bukti
$foto = $_FILES['bukti']['name'];
$tmp = $_FILES['bukti']['tmp_name'];
$nama_baru = time().'_'.$foto;
$path = "../assets/img/".$nama_baru;

if(move_uploaded_file($tmp, $path)){
    // Update status menjadi 'Menunggu Verifikasi' dan simpan nama file
    $query = mysqli_query($conn, "UPDATE pesanan SET status_bayar='Menunggu Verifikasi', bukti_bayar='$nama_baru' WHERE id_pesanan='$id'");
    
    if($query){
        echo "<script>alert('Bukti Terkirim! Menunggu konfirmasi admin.'); window.location='user_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Gagal Upload!'); window.location='user_dashboard.php';</script>";
}
?>