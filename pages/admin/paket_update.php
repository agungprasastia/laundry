<?php 
include '../../config/koneksi.php';
include '../../config/session_check.php';

$id = $_POST['id_paket'];
$nama = $_POST['nama_paket'];
$harga = $_POST['harga'];
$estimasi = $_POST['estimasi'];

$filename = $_FILES['foto']['name'];

if($filename == ""){

    $query = mysqli_query($conn,
        "UPDATE paket SET 
            nama_paket='$nama', 
            harga='$harga', 
            estimasi='$estimasi'
        WHERE id_paket='$id'"
    );

} else {

    // Validasi format file
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if(!in_array($ext, ['jpg','jpeg','png','gif'])){
        echo "<script>alert('Format gambar tidak valid!'); window.location='paket_edit.php?id=$id';</script>";
        exit();
    }

    $q_lama = mysqli_query($conn, "SELECT foto FROM paket WHERE id_paket='$id'");
    $d_lama = mysqli_fetch_assoc($q_lama);

    $foto_lama = $d_lama['foto'];

    if(file_exists("../../assets/img/$foto_lama")){
        unlink("../../assets/img/$foto_lama");
    }

    $nama_baru = time() . '_' . $filename;
    move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/$nama_baru");

    $query = mysqli_query($conn,
        "UPDATE paket SET 
            nama_paket='$nama',
            harga='$harga',
            estimasi='$estimasi',
            foto='$nama_baru'
        WHERE id_paket='$id'"
    );
}

if($query){
    echo "<script>alert('Data Berhasil Diupdate!'); window.location='paket.php';</script>";
} else {
    echo "<script>alert('Gagal Update Data!'); window.location='paket_edit.php?id=$id';</script>";
}
?>