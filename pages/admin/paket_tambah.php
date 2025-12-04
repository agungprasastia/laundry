<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$nama = $_POST['nama_paket'];
$harga = $_POST['harga'];
$estimasi = $_POST['estimasi'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$nama_baru = time() . '_' . $foto;
$path = "../../assets/img/" . $nama_baru;

if(move_uploaded_file($tmp, $path)){
    $query = mysqli_query($conn, "INSERT INTO paket VALUES(NULL, '$nama', '$harga', '$estimasi', '$nama_baru')");
    
    if($query){
        echo "<script>alert('Paket Berhasil Ditambahkan!'); window.location='paket.php';</script>";
    } else {
        echo "<script>alert('Gagal simpan database!'); window.location='paket.php';</script>";
    }
} else {
    echo "<script>alert('Gagal upload gambar! Pastikan folder assets/img ada.'); window.location='paket.php';</script>";
}
?>