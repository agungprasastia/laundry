<?php
include '../../config/koneksi.php';
include '../../config/session_check.php';

// Sanitasi data input
$nama      = mysqli_real_escape_string($conn, $_POST['nama']);
$id_paket  = intval($_POST['id_paket']);
$tanggal   = mysqli_real_escape_string($conn, $_POST['tanggal']);

// Tentukan ID pelanggan
$id_pelanggan = "NULL";
if(isset($_SESSION['role']) && $_SESSION['role'] == 'pelanggan'){
    $id_pelanggan = intval($_SESSION['id_pelanggan']);
}

// Query insert
$query = mysqli_query($conn, 
    "INSERT INTO pesanan 
        (nama_pelanggan, id_paket, berat, total_bayar, status, tanggal, id_pelanggan, status_bayar) 
     VALUES 
        ('$nama', '$id_paket', 0, 0, 'Baru', '$tanggal', $id_pelanggan, 'Belum Lunas')"
);

if($query){

    $id_baru = mysqli_insert_id($conn);

    // Jika user login sebagai pelanggan:
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'pelanggan'){
        echo "<script>alert('Pesanan Berhasil!'); window.location='user_dashboard.php';</script>";
        exit();
    }

    // Jika tamu (guest):
    echo "<script>
        alert('Pesanan Berhasil! ID Pesanan Anda: $id_baru. Mohon disimpan!');
        window.location='../cek_status.php?id=$id_baru';
    </script>";
    exit();

} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>
