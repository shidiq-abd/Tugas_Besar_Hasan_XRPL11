<?php

require 'koneksi.php';

$kode_mapel = $_POST['kode_mapel'];
$nama_mapel = $_POST['nama_mapel'];
$guru_id = $_POST['guru_id'];

$sql = "INSERT INTO mapel (kode_mapel, nama_mapel, guru_id) VALUES ('$kode_mapel', '$nama_mapel', '$guru_id')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: daftar_mapel.php");
    exit();
} else {
    echo "<script>alert('Data mapel gagal ditambahkan: " . mysqli_error($koneksi) . "'); window.location.href='form_mapel.php';</script>";
}