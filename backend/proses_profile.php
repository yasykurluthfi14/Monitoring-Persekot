<?php

include '../config.php';

if (isset($_POST)) {

$id = $_POST['id'];
$nama_lengkap = $_POST['nama'];
$dinas = $_POST['dinas'];
$unit = $_POST['unit'];
$alamat = $_POST['alamat'];

$rand = rand().
$ekstensi =  array('png','jpg','doc','pdf','xlsx');
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
  
if ($ukuran > 0 && in_array($ext, $ekstensi) ) {
    $xx = $rand.'_'.$filename;
    move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/foto'.$rand.'_'.$filename);
    mysqli_query($koneksi, " UPDATE login SET nama='$nama_lengkap', dinas='$dinas', unit='$unit', alamat='$alamat', foto='$xx'  WHERE id='$id'");
    
    echo "<script>alert('Update Profile Berhasil')</script>";
	echo "<script>location='../user/pages-profile.php';</script>";
} 
    
}


