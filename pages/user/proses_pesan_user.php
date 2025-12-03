<?php
include '../../config/koneksi.php';
include '../../config/session_check.php';

$id_pelanggan = $_POST['id_pelanggan'];
$nama = $_POST['nama_pelanggan'];
$id_paket = $_POST['id_paket'];
$tanggal = $_POST['tanggal'];

$query = mysqli_query($conn, "INSERT INTO pesanan 
    (nama_pelanggan, id_paket, berat, total_bayar, status, tanggal, id_pelanggan, status_bayar) 
    VALUES 
    ('$nama', '$id_paket', '0', '0', 'Baru', '$tanggal', '$id_pelanggan', 'Belum Lunas')");

if($query){
    echo "<script>alert('Pesanan Berhasil Dibuat! Tunggu admin menimbang cucian Anda.'); window.location='user_dashboard.php';</script>";
} else {
    echo "<script>alert('Gagal!'); window.location='user_dashboard.php';</script>";
}
?>