<?php

require 'koneksi.php';

$id_user  = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

$nip              = $_POST['nip'];
$nis              = $_POST['nis'];
$nama             = $_POST['nama'];
$kelas            = $_POST['kelas'];
$jenis_kelamin    = $_POST['jenis_kelamin'];

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sqluser = "UPDATE users SET username='$username', password='$hashed_password', role='$role' WHERE id='$id_user'";
} else {
    $sqluser = "UPDATE users SET username='$username', role='$role' WHERE id='$id_user'";
}

if (mysqli_query($koneksi, $sqluser)) {
    if (!empty($nip)) {
        $sqlguru = "UPDATE guru SET nip='$nip', nama='$nama', jenis_kelamin='$jenis_kelamin' WHERE user_id='$id_user'";
        if (!mysqli_query($koneksi, $sqlguru)) {
            die("Data guru gagal diperbarui: " . mysqli_error($koneksi));
        }
    } elseif (!empty($nis)) {
        $sqlsiswa = "UPDATE siswa SET nis='$nis', nama='$nama', kelas='$kelas', jenis_kelamin='$jenis_kelamin' WHERE user_id='$id_user'";
        if (!mysqli_query($koneksi, $sqlsiswa)) {
            die("Data siswa gagal diperbarui: " . mysqli_error($koneksi));
        }
    }

    header("Location: daftar_user.php");
    exit();
} else {
    echo "Data user gagal diperbarui: " . mysqli_error($koneksi);
}

?>