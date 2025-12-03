<?php 
session_start();
include 'koneksi.php'; 

$username = $_POST['username'];
$password = md5($_POST['password']);

// --- TAHAP 1: CEK TABEL ADMIN ---
$login_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek_admin = mysqli_num_rows($login_admin);

if($cek_admin > 0){
    // LOGIN SEBAGAI ADMIN
    $data = mysqli_fetch_array($login_admin);
    
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login"; // Session Standar
    $_SESSION['role'] = "admin";   // Pembeda Role
    
    header("location: ../pages/admin/dashboard.php"); 

} else {
    // --- TAHAP 2: CEK TABEL PELANGGAN ---
    $login_user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
    $cek_user = mysqli_num_rows($login_user);
    
    if($cek_user > 0){
        // LOGIN SEBAGAI PELANGGAN
        $data = mysqli_fetch_array($login_user);
        
        $_SESSION['username'] = $username;
        $_SESSION['nama_pelanggan'] = $data['nama_lengkap'];
        $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
        
        // PERBAIKAN: Gunakan nama 'status' dan nilai 'login'
        $_SESSION['status'] = "login"; 
        $_SESSION['role'] = "pelanggan";
        
    header("location: ../pages/user/user_dashboard.php"); 
        
    } else {
        // --- GAGAL KEDUANYA ---
        header("location: ../login.php?pesan=gagal");
    }
}
?>