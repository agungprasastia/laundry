<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$nama = $_POST['nama_paket'];
$harga = $_POST['harga'];
$estimasi = $_POST['estimasi'];

// Proses Upload Gambar
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
$path = "../../assets/img/" . $foto;

// Pindahkan file gambar ke folder assets/img/
if(move_uploaded_file($tmp, $path)){
    // Jika gambar berhasil diupload, simpan data ke database
    $query = mysqli_query($conn, "INSERT INTO paket VALUES(NULL, '$nama', '$harga', '$estimasi', '$foto')");
    
    if($query){
        echo "<script>alert('Paket Berhasil Ditambahkan!'); window.location='paket.php';</script>";
    } else {
        echo "<script>alert('Gagal simpan database!'); window.location='paket.php';</script>";
    }
} else {
    echo "<script>alert('Gagal upload gambar!'); window.location='paket.php';</script>";
}
?>