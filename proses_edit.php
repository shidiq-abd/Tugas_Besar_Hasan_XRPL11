
<?php
session_start();
require 'koneksi.php';

// Ambil identitas dari akun yang sedang login
if (!isset($_SESSION['id']) && !isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id'] ?? $_SESSION['id_user'];
$role    = $_SESSION['role'] ?? '';

$username       = trim($_POST['username'] ?? '');
$password       = $_POST['password'] ?? '';
$nip            = trim($_POST['nip'] ?? '');
$nis            = trim($_POST['nis'] ?? '');
$nama           = trim($_POST['nama'] ?? '');
$kelas          = trim($_POST['kelas'] ?? '');
$jenis_kelamin  = $_POST['jenis_kelamin'] ?? '';

// Validasi input dasar
if ($username === '') {
    die("Username tidak boleh kosong.");
}

if (!in_array($role, ['admin', 'guru', 'siswa'], true)) {
    die("Role akun tidak valid.");
}

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sqluser = "UPDATE users
                SET username = ?, password = ?
                WHERE id = ?";

    $stmtuser = mysqli_prepare($koneksi, $sqluser);
    mysqli_stmt_bind_param(
        $stmtuser, "ssi", $username, $hashed_password, $id_user
    );
} else {
    $sqluser = "UPDATE users
                SET username = ?
                WHERE id = ?";

    $stmtuser = mysqli_prepare($koneksi, $sqluser);
    mysqli_stmt_bind_param($stmtuser, "si", $username, $id_user);
}

if (mysqli_stmt_execute($stmtuser)) {

    $_SESSION['username'] = $username;

    if ($role === 'guru') {
        $sqlguru = "UPDATE guru
                    SET nip = ?, nama = ?, jenis_kelamin = ?
                    WHERE user_id = ?";

        $stmtguru = mysqli_prepare($koneksi, $sqlguru);
        mysqli_stmt_bind_param(
            $stmtguru, "sssi", $nip, $nama, $jenis_kelamin, $id_user
        );

        if (!mysqli_stmt_execute($stmtguru)) {
            die("Data guru gagal diperbarui: " .
                mysqli_stmt_error($stmtguru));
        }

    } elseif ($role === 'siswa') {
        $sqlsiswa = "UPDATE siswa
                     SET nis = ?, nama = ?, kelas = ?, jenis_kelamin = ?
                     WHERE user_id = ?";

        $stmtsiswa = mysqli_prepare($koneksi, $sqlsiswa);
        mysqli_stmt_bind_param(
            $stmtsiswa, "ssssi",
            $nis, $nama, $kelas, $jenis_kelamin, $id_user
        );

        if (!mysqli_stmt_execute($stmtsiswa)) {
            die("Data siswa gagal diperbarui: " .
                mysqli_stmt_error($stmtsiswa));
        }
    }

    header("Location: profile.php");
    exit();

} else {
    echo "Data user gagal diperbarui: " .
         mysqli_stmt_error($stmtuser);
}
?>