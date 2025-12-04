<?php
include '../../config/koneksi.php';
session_start();

if(!isset($_SESSION['id_pelanggan'])){
    header("location:../../login.php");
    exit();
}

// Ambil data dari Session & Post
$id_pelanggan = $_SESSION['id_pelanggan'];
$nama         = $_SESSION['nama_pelanggan'];
$id_paket     = intval($_POST['id_paket']);
$tanggal      = $_POST['tanggal'];

$query = mysqli_query($conn, 
    "INSERT INTO pesanan 
        (nama_pelanggan, id_paket, berat, total_bayar, status, tanggal, id_pelanggan, status_bayar) 
     VALUES 
        ('$nama', '$id_paket', 0, 0, 'Baru', '$tanggal', '$id_pelanggan', 'Belum Lunas')"
);

if($query){
    echo "<script>alert('Pesanan Berhasil! Silakan cek Dashboard Anda.'); window.location='user_dashboard.php';</script>";
} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>