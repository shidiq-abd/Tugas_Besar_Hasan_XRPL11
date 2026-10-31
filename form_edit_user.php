<?php

include 'koneksi.php';

// cek apakah id dan role dikirim dari daftar_user.php
if (!isset($_GET['id']) || !isset($_GET['role'])) {
    echo "<script>
        alert('ID atau role tidak ditemukan');
        window.location.href = 'daftar_user.php';
    </script>";
    exit();
}

// ambil id dan role dari URL
$id = $_GET['id'];
$role = $_GET['role'];

/* =====================================================
   =====================================================
   ADMIN
   =====================================================
   ===================================================== */

if ($role === 'admin') {

    $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

    $result = mysqli_fetch_assoc(mysqli_query($koneksi, $query));

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Edit Admin</title>
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
                    <h4>Form Edit User (Admin)</h4>
                </div>
                <div class="card-body">
                    <form action="proses_edit_user.php" method="POST">
                        <h3>Data Kredensial Akun</h3>
                        <label>Username:</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            value="<?= $result['username'] ?>"
                            placeholder="Username Akun"
                            required
                        >
                        <br>
                        <label>Password Akun:</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Kosongkan jika password tidak diubah"
                        >
                        <br>
                        <!-- data yang dibutuhkan proses_update.php -->
                        <input
                            type="hidden"
                            name="role"
                            value="admin"
                        >
                        <input
                            type="hidden"
                            name="id_user"
                            value="<?= $result['id'] ?>"
                        >
                        <button
                            type="submit"
                            name="edit"
                            class="btn btn-primary"
                        >
                            Simpan Data
                        </button>
                        <a
                            href="daftar_user.php"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
/* =====================================================
   GURU
   ===================================================== */

} elseif ($role === 'guru') {
    // ambil data users + data guru
    $queryguru = "
        SELECT
            users.id AS user_id,
            users.username,
            users.role,

            guru.id AS guru_id,
            guru.nip,
            guru.nama,
            guru.jenis_kelamin

        FROM users
        JOIN guru
        ON users.id = guru.user_id
        WHERE users.id = '$id'
        LIMIT 1
    ";
    $resultguru = mysqli_fetch_assoc(mysqli_query($koneksi, $queryguru));
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Edit Guru</title>
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
                    <h4>Form Edit User (Guru)</h4>
                </div>
                <div class="card-body">
                    <form action="proses_edit_user.php" method="POST">
                        <h3>Data Profil Guru</h3>
                        <label>NIP:</label>
                        <input
                            type="text"
                            name="nip"
                            class="form-control"
                            value="<?= $resultguru['nip'] ?>"
                            placeholder="Nomor Induk Pegawai"
                            required
                        >
                        <br>
                        <label>Nama Lengkap:</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="<?= $resultguru['nama'] ?>"
                            placeholder="Nama Lengkap Guru"
                            required
                        >
                        <br>
                        <label>Jenis Kelamin:</label>
                        <br>
                        <input
                            type="radio"
                            name="jenis_kelamin"
                            value="L"
                            class="form-check-input"
                            <?= ($resultguru['jenis_kelamin'] == 'L') ? 'checked' : '' ?>
                            required
                        >
                        Laki-laki
                        <br>
                        <input
                            type="radio"
                            name="jenis_kelamin"
                            value="P"
                            class="form-check-input"
                            <?= ($resultguru['jenis_kelamin'] == 'P') ? 'checked' : '' ?>
                        >
                        Perempuan
                        <br><br>
                        <!-- ID guru -->
                        <input
                            type="hidden"
                            name="id_guru"
                            value="<?= $resultguru['guru_id'] ?>"
                        >
                        <hr>
                        <h3>Data Kredensial Akun</h3>
                        <label>Username:</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            value="<?= $resultguru['username'] ?>"
                            placeholder="Username Akun"
                            required
                        >
                        <br>
                        <label>Password Akun:</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Kosongkan jika password tidak diubah"
                        >
                        <br>
                        <!-- data untuk proses update -->
                        <input
                            type="hidden"
                            name="role"
                            value="guru"
                        >
                        <input
                            type="hidden"
                            name="id_user"
                            value="<?= $resultguru['user_id'] ?>"
                        >
                        <button
                            type="submit"
                            name="edit"
                            class="btn btn-primary"
                        >
                            Simpan Data
                        </button>
                        <a
                            href="daftar_user.php"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
/* =====================================================
   SISWA
   ===================================================== */

} elseif ($role === 'siswa') {


    // ambil data users + siswa

    $querysiswa = "
        SELECT
            users.id AS user_id,
            users.username,
            users.role,

            siswa.id AS siswa_id,
            siswa.nis,
            siswa.nama,
            siswa.kelas,
            siswa.jenis_kelamin

        FROM users

        JOIN siswa
        ON users.id = siswa.user_id

        WHERE users.id = '$id'

        LIMIT 1
    ";
    $resultsiswa = mysqli_fetch_assoc(
        mysqli_query($koneksi, $querysiswa)
    );
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Edit Siswa</title>
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
                    <h4>Form Edit User (Siswa)</h4>
                </div>
                <div class="card-body">
                    <form action="proses_edit_user.php" method="POST">
                        <h3>Data Profil Siswa</h3>
                        <label>NIS:</label>
                        <input
                            type="text"
                            name="nis"
                            class="form-control"
                            value="<?= $resultsiswa['nis'] ?>"
                            placeholder="Nomor Induk Siswa"
                            required
                        >
                        <br>
                        <label>Nama Lengkap:</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            value="<?= $resultsiswa['nama'] ?>"
                            placeholder="Nama Lengkap Siswa"
                            required
                        >
                        <br>
                        <label>Kelas:</label>
                        <input
                            type="text"
                            name="kelas"
                            class="form-control"
                            value="<?= $resultsiswa['kelas'] ?>"
                            placeholder="Contoh: XI-RPL-1"
                            required
                        >
                        <br>
                        <label>Jenis Kelamin:</label>
                        <br>
                        <input
                            type="radio"
                            name="jenis_kelamin"
                            value="L"
                            class="form-check-input"
                            <?= ($resultsiswa['jenis_kelamin'] == 'L') ? 'checked' : '' ?>
                            required
                        >
                        Laki-laki
                        <br>
                        <input
                            type="radio"
                            name="jenis_kelamin"
                            value="P"
                            class="form-check-input"
                            <?= ($resultsiswa['jenis_kelamin'] == 'P') ? 'checked' : '' ?>
                        >
                        Perempuan
                        <br><br>
                        <!-- ID siswa -->
                        <input
                            type="hidden"
                            name="id_siswa"
                            value="<?= $resultsiswa['siswa_id'] ?>"
                        >
                        <hr>
                        <h3>Data Kredensial Akun</h3>
                        <label>Username:</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            value="<?= $resultsiswa['username'] ?>"
                            placeholder="Username Akun"
                            required
                        >
                        <br>
                        <label>Password Akun:</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Kosongkan jika password tidak diubah"
                        >
                        <br>
                        <!-- data untuk proses update -->
                        <input
                            type="hidden"
                            name="role"
                            value="siswa"
                        >
                        <input
                            type="hidden"
                            name="id_user"
                            value="<?= $resultsiswa['user_id'] ?>"
                        >
                        <button
                            type="submit"
                            name="edit"
                            class="btn btn-primary"
                        >
                            Simpan Data
                        </button>
                        <a
                            href="daftar_user.php"
                            class="btn btn-secondary"
                        >
                            Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
/* =====================================================
   ROLE TIDAK DIKENAL
   ===================================================== */
} else {

    echo "<script>
        alert('Role tidak valid');
        window.location.href = 'daftar_user.php';
    </script>";

}

?>