<?php require_once 'navbar.php'?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Tambah Siswa</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-6 col-xl-5">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4">
                    <h2 class="h4 mb-0">Form Tambah Siswa</h2>
                </div>

                <div class="card-body p-4">
                    <form action="proses_tambah_user.php" method="POST">

                        <!-- Data Profil Siswa -->
                        <h3 class="h5 mb-4">Data Profil Siswa</h3>

                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input
                                type="text"
                                name="nis"
                                id="nis"
                                class="form-control"
                                placeholder="Contoh: 1023004"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap Siswa</label>
                            <input
                                type="text"
                                name="namas"
                                id="nama"
                                class="form-control"
                                placeholder="Contoh: Nabila Syakieb"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input
                                type="text"
                                name="kelas"
                                id="kelas"
                                class="form-control"
                                placeholder="Contoh: X-RPL-1"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Jenis Kelamin</label>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="jenis_kelamins"
                                    id="siswa_laki"
                                    value="L"
                                    required
                                >
                                <label class="form-check-label" for="siswa_laki">Laki-laki</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="jenis_kelamins"
                                    id="siswa_perempuan"
                                    value="P"
                                >
                                <label class="form-check-label" for="siswa_perempuan">Perempuan</label>
                            </div>
                        </div>

                        <!-- Data Users -->
                        <div class="border rounded-3 bg-light p-3 p-md-4 mb-4">
                            <h3 class="h5 mb-1">Data Kredensial Akun</h3>
                            <p class="text-secondary small mb-4">Data untuk tabel <code>users</code>.</p>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control"
                                    placeholder="Contoh: siswa_nabila"
                                    required
                                >
                            </div>

                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Masukkan password akun"
                                    required
                                >
                            </div>

                            <!-- Bisa langsung dipakai saat membuat INSERT users -->
                            <input type="hidden" name="role" value="siswa">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="kirim" class="btn btn-primary">
                                Simpan Data
                            </button>
                            <a href="daftar_user.php" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
