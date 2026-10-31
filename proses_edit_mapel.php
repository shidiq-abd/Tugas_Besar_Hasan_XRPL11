<?php

require 'koneksi.php';

$kode_mapel = $_POST['kode_mapel'];
$nama_mapel = $_POST['nama_mapel'];
$guru_id = $_POST['guru_id'];

$sql = "UPDATE mapel SET kode_mapel='$kode_mapel', nama_mapel='$nama_mapel', guru_id='$guru_id' WHERE id='{$_POST['id']}'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: daftar_mapel.php");
    exit();
} else {
    echo "Data user gagal diperbarui: " . mysqli_error($koneksi);
}

?>