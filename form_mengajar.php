<?php
require 'koneksi.php';
require_once 'navbar.php';

$kelas_query = mysqli_query($koneksi, "SELECT DISTINCT kelas FROM siswa ORDER BY kelas ASC");
$mapel_query = mysqli_query($koneksi, "SELECT mapel.id, mapel.nama_mapel, mapel.kode_mapel, guru.nama AS nama_guru
                                      FROM mapel
                                      JOIN guru ON mapel.guru_id = guru.id
                                      ORDER BY guru.nama ASC, mapel.nama_mapel ASC");
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Tambah Mengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4">
                    <h1 class="h4 mb-0">Form Tambah Mengajar</h1>
                </div>
                <div class="card-body p-4">
                    <h2 class="h5 mb-3">Pengajar</h2>
                    <form action="proses_mengajar.php" method="POST">
                        <input type="hidden" name="aksi" value="tambah">

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Pilih Kelas</label>
                            <select name="kelas" id="kelas" class="form-select" required>
                                <option value="">Pilih Kelas...</option>
                                <?php while ($kelas = mysqli_fetch_assoc($kelas_query)) { ?>
                                    <option value="<?= htmlspecialchars($kelas['kelas'], ENT_QUOTES); ?>">
                                        <?= htmlspecialchars($kelas['kelas']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="mapel_id" class="form-label">Pilih Guru</label>
                            <select name="mapel_id" id="mapel_id" class="form-select" required>
                                <option value="">Pilih Guru...</option>
                                <?php while ($mapel = mysqli_fetch_assoc($mapel_query)) { ?>
                                    <option value="<?= $mapel['id']; ?>">
                                        <?= htmlspecialchars($mapel['nama_guru'] . ' | ' . $mapel['nama_mapel']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="form-text">Nama mata pelajaran ditampilkan agar pilihan guru tidak membingungkan jika guru mengajar lebih dari satu mapel.</div>
                        </div>

                        <button type="submit" id="tombolSimpan" class="btn btn-primary">
                        Simpan Data
                        </button>
                        <a href="daftar_mengajar.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelector('form').addEventListener('submit', function() {
    const tombol = document.getElementById('tombolSimpan');

    tombol.disabled = true;
    tombol.innerText = 'Menyimpan...';
});
</script>
</body>
</html>
