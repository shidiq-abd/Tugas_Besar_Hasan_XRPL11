<?php

require 'koneksi.php';

$nip            =   $_POST['nip'];
$nis            =   $_POST['nis'];
$nama           =   $_POST['nama'];
$namas           =   $_POST['namas'];
$kelas          =   $_POST['kelas'];
$jenis_kelamin  =   $_POST['jenis_kelamin'];
$jenis_kelamins  =   $_POST['jenis_kelamins'];


$username       =   $_POST['username'];
$password       =   password_hash($_POST['password'], PASSWORD_DEFAULT);
$role           =   $_POST['role'];

$sqluser = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
if (mysqli_query($koneksi, $sqluser)) {

    $user_id = mysqli_insert_id($koneksi);

    if (!empty($nip)) {
        $sqlguru = "INSERT INTO guru
                    (user_id, nip, nama, jenis_kelamin)
                    VALUES
                    ('$user_id', '$nip', '$nama', '$jenis_kelamin')";

        if (!mysqli_query($koneksi, $sqlguru)) {
            die("Data guru gagal: " . mysqli_error($koneksi));
        }
    } elseif (!empty($nis)) {
        $sqlsiswa = "INSERT INTO siswa
                     (user_id, nis, nama, kelas, jenis_kelamin)
                     VALUES
                     ('$user_id', '$nis', '$namas', '$kelas', '$jenis_kelamins')";
        if (!mysqli_query($koneksi, $sqlsiswa)) {
            die("Data siswa gagal: " . mysqli_error($koneksi));
        }
    }

    header("Location: daftar_user.php");
    exit();

} else {
    echo "Data user gagal: " . mysqli_error($koneksi);
}

?>