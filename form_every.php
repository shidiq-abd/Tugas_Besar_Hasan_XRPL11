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
                    <p class="text-secondary mb-0">Buat akun admin, guru, atau siswa melalui satu form.</p>
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

                            <div>
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="admin" selected>Admin</option>
                                    <option value="guru">Guru</option>
                                    <option value="siswa">Siswa</option>
                                </select>
                            </div>
                        </div>

                        <div id="keteranganAdmin" class="alert alert-dark mb-4" role="alert">
                            Role <strong>Admin</strong> hanya membutuhkan username dan password.
                        </div>

                        <div id="formGuru" class="border rounded-3 p-3 p-md-4 mb-4 d-none">
                            <h2 class="h5 mb-1">Data Profil Guru</h2>
                            <p class="text-secondary small mb-4">Bagian ini tampil karena role Guru dipilih.</p>

                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input
                                    type="text"
                                    name="nip"
                                    id="nip"
                                    class="form-control input-guru"
                                    placeholder="Contoh: 198507102010011002"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="namaGuru" class="form-label">Nama Lengkap Guru</label>
                                <input
                                    type="text"
                                    name="nama"
                                    id="namaGuru"
                                    class="form-control input-guru"
                                    placeholder="Contoh: Ahmad Ibrahim, S.Pd"
                                >
                            </div>

                            <div>
                                <label class="form-label d-block">Jenis Kelamin</label>

                                <input type="hidden" name="jenis_kelamin" value="">

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input input-guru"
                                        type="radio"
                                        name="jenis_kelamin"
                                        id="guru_laki"
                                        value="L"
                                    >
                                    <label class="form-check-label" for="guru_laki">Laki-laki</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input input-guru"
                                        type="radio"
                                        name="jenis_kelamin"
                                        id="guru_perempuan"
                                        value="P"
                                    >
                                    <label class="form-check-label" for="guru_perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div id="formSiswa" class="border rounded-3 p-3 p-md-4 mb-4 d-none">
                            <h2 class="h5 mb-1">Data Profil Siswa</h2>
                            <p class="text-secondary small mb-4">Bagian ini tampil karena role Siswa dipilih.</p>

                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input
                                    type="text"
                                    name="nis"
                                    id="nis"
                                    class="form-control input-siswa"
                                    placeholder="Contoh: 1023004"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="namaSiswa" class="form-label">Nama Lengkap Siswa</label>
                                <input
                                    type="text"
                                    name="namas"
                                    id="namaSiswa"
                                    class="form-control input-siswa"
                                    placeholder="Contoh: Nabila Syakieb"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input
                                    type="text"
                                    name="kelas"
                                    id="kelas"
                                    class="form-control input-siswa"
                                    placeholder="Contoh: XI-RPL-1"
                                >
                            </div>

                            <div>
                                <label class="form-label d-block">Jenis Kelamin</label>

                                <input type="hidden" name="jenis_kelamins" value="">

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input input-siswa"
                                        type="radio"
                                        name="jenis_kelamins"
                                        id="siswa_laki"
                                        value="L"
                                    >
                                    <label class="form-check-label" for="siswa_laki">Laki-laki</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input input-siswa"
                                        type="radio"
                                        name="jenis_kelamins"
                                        id="siswa_perempuan"
                                        value="P"
                                    >
                                    <label class="form-check-label" for="siswa_perempuan">Perempuan</label>
                                </div>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const pilihanRole = document.getElementById('role');
    const keteranganAdmin = document.getElementById('keteranganAdmin');
    const formGuru = document.getElementById('formGuru');
    const formSiswa = document.getElementById('formSiswa');
    const inputGuru = document.querySelectorAll('.input-guru');
    const inputSiswa = document.querySelectorAll('.input-siswa');

    function kosongkanInput(daftarInput) {
        daftarInput.forEach(function (input) {
            if (input.type === 'radio') {
                input.checked = false;
            } else {
                input.value = '';
            }

            input.required = false;
        });
    }

    function wajibkanInput(daftarInput) {
        daftarInput.forEach(function (input) {
            input.required = true;
        });
    }

    function tampilkanFormSesuaiRole() {
        const role = pilihanRole.value;

        keteranganAdmin.classList.toggle('d-none', role !== 'admin');
        formGuru.classList.toggle('d-none', role !== 'guru');
        formSiswa.classList.toggle('d-none', role !== 'siswa');

        if (role === 'guru') {
            kosongkanInput(inputSiswa);
            wajibkanInput(inputGuru);
        } else if (role === 'siswa') {
            kosongkanInput(inputGuru);
            wajibkanInput(inputSiswa);
        } else {
            kosongkanInput(inputGuru);
            kosongkanInput(inputSiswa);
        }
    }

    pilihanRole.addEventListener('change', tampilkanFormSesuaiRole);
    tampilkanFormSesuaiRole();
</script>
</body>
</html>
