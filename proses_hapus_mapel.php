
<?php

require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Hapus data mengajar yang menggunakan mapel ini
    $mengajar = "DELETE FROM mengajar WHERE mapel_id = $id";

    // Hapus data mapel
    $mapel = "DELETE FROM mapel WHERE id = $id";

    if (mysqli_query($koneksi, $mengajar)) {
        if (mysqli_query($koneksi, $mapel)) {
            echo "<script>
                alert('Data mapel berhasil dihapus.');
                window.location.href = 'daftar_mapel.php';
            </script>";
        } else {
            echo "<script>
                alert('Terjadi kesalahan saat menghapus mapel: " . mysqli_error($koneksi) . "');
                window.location.href = 'daftar_mapel.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat menghapus data mengajar: " . mysqli_error($koneksi) . "');
            window.location.href = 'daftar_mapel.php';
        </script>";
    }

} else {
    echo "<script>
        alert('ID mapel tidak ditemukan.');
        window.location.href = 'daftar_mapel.php';
    </script>";
}

?>
