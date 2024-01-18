<?php

include '../config.php';

if (isset($_POST)) {

    $id = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $status = 1;

    $rand = rand() .
        $ekstensi = array('png', 'jpg', 'doc', 'pdf', 'xlsx');
    $filename = $_FILES['dokumen']['name'];
    $ukuran = $_FILES['dokumen']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if ($ukuran > 0 && in_array($ext, $ekstensi)) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['dokumen']['tmp_name'], '../assets/img/dokumen' . $rand . '_' . $filename);
        mysqli_query($koneksi, "INSERT INTO data_persekot (id, nama_lengkap, dokumen, status_dokumen)
    VALUES ('$id','$nama_lengkap','$xx','$status')");
        header("location:../user/dashboard_user.php?pesan=success");
    }

}


