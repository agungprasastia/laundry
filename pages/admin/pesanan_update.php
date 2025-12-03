<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$id = $_POST['id'];
$berat = $_POST['berat'];
$harga_per_kg = $_POST['harga_per_kg'];
$status = $_POST['status'];
$status_bayar = $_POST['status_bayar'];

// Hitung Total Bayar Otomatis
$total_bayar = $berat * $harga_per_kg;

// Update Database
$query = mysqli_query($conn, "UPDATE pesanan SET 
    berat='$berat', 
    total_bayar='$total_bayar', 
    status='$status',
    status_bayar='$status_bayar'
    WHERE id_pesanan='$id'");

if($query){
    header("location:pesanan.php");
} else {
    echo "Gagal Update";
}
?>