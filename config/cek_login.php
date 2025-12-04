<?php 
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

// 1. CEK ADMIN
$admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
if(mysqli_num_rows($admin) > 0){
    $_SESSION['status'] = "login";
    $_SESSION['role'] = "admin";
    $_SESSION['username'] = $username;

    header("Location: ../pages/admin/dashboard.php");
    exit;
}

// 2. CEK USER
$user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
if(mysqli_num_rows($user) > 0){
    $d = mysqli_fetch_assoc($user);

    $_SESSION['status'] = "login";
    $_SESSION['role'] = "pelanggan";
    $_SESSION['username'] = $username;
    $_SESSION['nama_pelanggan'] = $d['nama_lengkap'];
    $_SESSION['id_pelanggan'] = $d['id_pelanggan'];

    header("Location: ../pages/user/user_dashboard.php");
    exit;
}


header("Location: ../login.php?pesan=gagal");
exit;
?>