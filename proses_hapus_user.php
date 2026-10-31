<?php

require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $user = "DELETE FROM users WHERE id = $id";
    $siswa = "DELETE FROM siswa WHERE user_id = $id";
    $guru = "DELETE FROM guru WHERE user_id = $id";
    if (mysqli_query($koneksi, $user)) {
        mysqli_query($koneksi, $siswa);
        mysqli_query($koneksi, $guru);
        echo "<script>alert('Data user berhasil dihapus.'); window.location.href = 'daftar_user.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data user: " . mysqli_error($koneksi) . "'); window.location.href = 'daftar_user.php';</script>";
}
} else {
    echo "<script>alert('ID user tidak ditemukan.'); window.location.href = 'daftar_user.php';</script>";
}
?>