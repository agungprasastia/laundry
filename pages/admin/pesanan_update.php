<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

// 2. Cek Keamanan: Hanya Admin yang boleh akses file ini
if(isset($_SESSION['role']) && $_SESSION['role'] != 'admin'){
    header("location:../../login.php");
    exit();
}

// 3. Ambil data yang dikirim dari form di pesanan.php
$id             = $_POST['id'];
$berat          = floatval($_POST['berat']);
$harga_per_kg   = intval($_POST['harga_per_kg']);
$status         = $_POST['status'];
$status_bayar   = $_POST['status_bayar'];

// Hitung Total Bayar Otomatis
// Rumus: Berat Cucian x Harga Paket
$total_bayar = $berat * $harga_per_kg;

//  Update Database
$query = mysqli_query($conn, "UPDATE pesanan SET 
    berat = '$berat', 
    total_bayar = '$total_bayar', 
    status = '$status', 
    status_bayar = '$status_bayar'
    WHERE id_pesanan = '$id'");

if($query){
    header("location:pesanan.php");
} else {
    echo "Gagal Update Data: " . mysqli_error($conn);
}
?>