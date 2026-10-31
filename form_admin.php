<?php require_once 'navbar.php'?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Tambah Pengguna</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6">

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4">
                    <h1 class="h4 mb-1">Form Tambah Pengguna</h1>
                </div>

                <div class="card-body p-4">
                    <form action="proses_tambah_user.php" method="POST">
                        <input type="hidden" name="aksi" value="insert">

                        <div class="border rounded-3 bg-light p-3 p-md-4 mb-4">
                            <h2 class="h5 mb-1">Data Akun</h2>
                            <p class="text-secondary small mb-4">Username dan password wajib untuk semua role.</p>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control"
                                    placeholder="Masukkan username"
                                    autocomplete="username"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    autocomplete="new-password"
                                    required
                                >
                            </div>

                              <div class="d-flex gap-2">
                              <button type="submit" name="kirim" class="btn btn-primary">
                                Simpan Data
                              </button>
                              <a href="daftar_user.php" class="btn btn-secondary">
                                Kembali
                              </a>
                            </div>
                        </div>
                    </form>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            </div>
        </div>
    </div>
</main>
</body>