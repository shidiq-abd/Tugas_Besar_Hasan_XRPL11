<?php
require 'koneksi.php';
require_once 'navbar.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Tambah Mapel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4">
                    <h1 class="h4 mb-1">Form Tambah mapel</h1>
                </div>

                <div class="card-body p-4">
                    <form action="proses_tambah_mapel.php" method="POST">
                        <input type="hidden" name="aksi" value="insert">

                        <div class="border rounded-3 bg-light p-3 p-md-4 mb-4">
                            <h2 class="h5 mb-1">Data Mapel</h2>
                            <p class="text-secondary small mb-4">Masukkan informasi mata pelajaran.</p>

                            <div class="mb-3">
                                <label for="kode_mapel" class="form-label">Kode Mapel</label>
                                <input
                                    type="text"
                                    name="kode_mapel"
                                    id="kode_mapel"
                                    class="form-control"
                                    placeholder="Masukkan kode mapel"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="nama_mapel" class="form-label">Nama Mapel</label>
                                <input
                                    type="text"
                                    name="nama_mapel"
                                    id="nama_mapel"
                                    class="form-control"
                                    placeholder="Masukkan nama mapel"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="guru_id" class="form-label">Guru</label>
                                <select name="guru_id" id="guru_id" class="form-select" required>
                                  <option value="">Pilih Guru</option>

                                     <?php
                                         $guru_query = "SELECT * FROM guru";
                                         $guru_result = mysqli_query($koneksi, $guru_query);

                                         while ($guru = mysqli_fetch_assoc($guru_result)) {
                                          echo "<option value='{$guru['id']}'>{$guru['nama']}</option>";
                                         }
                                       ?>

                                 </select>
                            </div>
                        </div>

                        <button type="submit" name="kirim" class="btn btn-primary">
                                Simpan Data
                            </button>
                            <a href="daftar_mapel.php" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</main>
</body>
</html>
