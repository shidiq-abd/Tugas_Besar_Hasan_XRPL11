<?php

include 'koneksi.php';

// cek apakah id dan role dikirim dari daftar_user.php
if (!isset($_GET['id'])) {
    echo "<script>
        alert('ID tidak ditemukan');
        window.location.href = 'daftar_mapel.php';
    </script>";
    exit();
}

// ambil id dan role dari URL
$id = $_GET['id'];
$mapel = "SELECT * FROM mapel WHERE id = '$id' LIMIT 1";
$result = mysqli_fetch_assoc(mysqli_query($koneksi, $mapel));

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Edit mapel</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Mapel</h4>
                </div>
                <div class="card-body">
                    <form action="proses_edit_mapel.php" method="POST">
                        <h3>Data Mapel</h3>
                        <label>Kode Mapel:</label>
                        <input
                            type="text"
                            name="kode_mapel"
                            class="form-control"
                            value="<?= $result['kode_mapel'] ?>"
                            placeholder="Kode Mapel"
                            required
                        >
                        <br>
                        <label>Nama Mapel:</label>
                        <input
                            type="text"
                            name="nama_mapel"
                            class="form-control"
                            value="<?= $result['nama_mapel'] ?>"
                            placeholder="Nama Mapel"
                            required
                        >
                        <br>
                        <label>Guru:</label>
                        <select name="guru_id" class="form-control" required>
                            <option value="">Pilih Guru</option>
                            <?php
                            $guru_query = "SELECT * FROM guru";
                            $guru_result = mysqli_query($koneksi, $guru_query);
                            while ($guru = mysqli_fetch_assoc($guru_result)) {
                                $selected = ($guru['id'] == $result['guru_id']) ? 'selected' : '';
                                echo "<option value='{$guru['id']}' $selected>{$guru['nama']}</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>