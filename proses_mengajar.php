<?php
require 'koneksi.php';

$aksi = $_POST['aksi'] ?? '';

if ($aksi === 'tambah') {
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas'] ?? '');
    $mapel_id = (int) ($_POST['mapel_id'] ?? 0);

    if ($kelas === '' || $mapel_id < 1) {
        die('Kelas dan mata pelajaran harus dipilih. <a href="form_mengajar.php">Kembali</a>');
    }

    $siswa_query = mysqli_query(
        $koneksi,
        "SELECT id FROM siswa WHERE kelas = '$kelas'"
    );

    if (!$siswa_query || mysqli_num_rows($siswa_query) === 0) {
        die('Tidak ada siswa pada kelas tersebut. <a href="form_mengajar.php">Kembali</a>');
    }

    $berhasil = 0;

    while ($siswa = mysqli_fetch_assoc($siswa_query)) {
        $siswa_id = (int) $siswa['id'];

        $sql = "INSERT INTO mengajar (mapel_id, siswa_id)
                SELECT $mapel_id, $siswa_id
                WHERE NOT EXISTS (
                    SELECT 1 FROM mengajar
                    WHERE mapel_id = $mapel_id
                    AND siswa_id = $siswa_id
                )";

        if (mysqli_query($koneksi, $sql)) {
            $berhasil += mysqli_affected_rows($koneksi);
        }
    }

    if ($berhasil > 0) {
        header('Location: daftar_mengajar.php');
        exit();
    }
}
    echo "Data tidak ditambahkan. Mungkin semua siswa sudah terdaftar untuk mata pelajaran ini. ";
    echo '<a href="form_mengajar.php">Kembali</a>';
?>
