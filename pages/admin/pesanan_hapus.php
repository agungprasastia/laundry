<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$id = $_GET['id'];

$cek_data = mysqli_query($conn, "SELECT bukti_bayar FROM pesanan WHERE id_pesanan='$id'");
$data = mysqli_fetch_array($cek_data);
$bukti_foto = $data['bukti_bayar'];

if(!empty($bukti_foto) && file_exists("../assets/img/$bukti_foto")){
    unlink("../../assets/img/$bukti_foto");
}

$query = mysqli_query($conn, "DELETE FROM pesanan WHERE id_pesanan='$id'");

if($query){
    echo "<script>alert('Data Pesanan Berhasil Dihapus!'); window.location='pesanan.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='pesanan.php';</script>";
}
?>