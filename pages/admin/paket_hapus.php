<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$id = intval($_GET['id']);
$foto = $_GET['foto'];

if(file_exists("../assets/img/$foto")){
    unlink("../assets/img/$foto");
}

$query = mysqli_query($conn, "DELETE FROM paket WHERE id_paket='$id'");

if($query){
    echo "<script>alert('Paket Berhasil Dihapus!'); window.location='paket.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='paket.php';</script>";
}
?>
