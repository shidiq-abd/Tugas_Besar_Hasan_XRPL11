<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'koneksi.php';

$role = strtolower($_SESSION['role'] ?? '');
$userId = $_SESSION['id'] ?? $_SESSION['id_user'] ?? null;

if (!$userId || !in_array($role, ['admin', 'guru', 'siswa'], true)) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'] ?? '';
$nama = $_SESSION['nama'] ?? '';
$detail = [];

$stmt = mysqli_prepare($koneksi, 'SELECT username FROM users WHERE id = ? LIMIT 1');
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) $username = $row['username'];
    mysqli_stmt_close($stmt);
}

if ($role === 'guru') {
    $stmt = mysqli_prepare($koneksi, 'SELECT id, nip, nama, jenis_kelamin FROM guru WHERE user_id = ? LIMIT 1');
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $detail = mysqli_fetch_assoc($res) ?: [];
        mysqli_stmt_close($stmt);
    }
    $nama = $detail['nama'] ?? $nama;
} elseif ($role === 'siswa') {
    $stmt = mysqli_prepare($koneksi, 'SELECT id, nis, nama, kelas, jenis_kelamin FROM siswa WHERE user_id = ? LIMIT 1');
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $detail = mysqli_fetch_assoc($res) ?: [];
        mysqli_stmt_close($stmt);
    }
    $nama = $detail['nama'] ?? $nama;
}
function e($value) { return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengaturan Akun - SIPN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f5f7fb}.edit-wrap{max-width:760px;margin:36px auto}.card{border:0;border-radius:14px;box-shadow:0 6px 24px rgba(0,0,0,.06)}.section-title{font-size:1.05rem;font-weight:700}
  </style>
</head>
<body>
<main class="container edit-wrap">
  <div class="mb-4">
    <h1 class="h3 fw-bold">Pengaturan Akun</h1>
    <p class="text-secondary mb-0">Ubah data akun sesuai role yang sedang login: <span class="badge text-bg-primary"><?= e(ucfirst($role)) ?></span></p>
  </div>

  <div class="card">
    <div class="card-body p-4 p-md-5">
      <form action="proses_edit.php" method="POST">
        <h2 class="section-title mb-3">Data Kredensial Akun</h2>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input id="username" class="form-control" type="text" name="username" value="<?= e($username) ?>" required maxlength="100">
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password Baru</label>
          <input id="password" class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah password">
          <div class="form-text">Jangan masukkan password lama jika tidak ingin mengubahnya.</div>
        </div>

        <?php if ($role === 'guru'): ?>
          <hr><h2 class="section-title mb-3">Data Profil Guru</h2>
          <div class="mb-3">
            <label class="form-label" for="nip">NIP</label>
            <input id="nip" class="form-control" name="nip" value="<?= e($detail['nip'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input id="nama" class="form-control" name="nama" value="<?= e($detail['nama'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label d-block">Jenis Kelamin</label>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="guruL" name="jenis_kelamin" value="L" <?= (($detail['jenis_kelamin'] ?? '') === 'L') ? 'checked' : '' ?> required>
            <label class="form-check-label" for="guruL">Laki-laki</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="guruP" name="jenis_kelamin" value="P" <?= (($detail['jenis_kelamin'] ?? '') === 'P') ? 'checked' : '' ?>><label class="form-check-label" for="guruP">Perempuan</label></div>
          </div>
          <input type="hidden" name="id_guru" value="<?= e($detail['id'] ?? '') ?>">
        <?php elseif ($role === 'siswa'): ?>
          <hr><h2 class="section-title mb-3">Data Profil Siswa</h2>
          <div class="mb-3">
            <label class="form-label" for="nis">NIS</label>
            <input id="nis" class="form-control" name="nis" value="<?= e($detail['nis'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input id="nama" class="form-control" name="nama" value="<?= e($detail['nama'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="kelas">Kelas</label>
            <input id="kelas" class="form-control" name="kelas" value="<?= e($detail['kelas'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label d-block">Jenis Kelamin</label>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="siswaL" name="jenis_kelamin" value="L" <?= (($detail['jenis_kelamin'] ?? '') === 'L') ? 'checked' : '' ?> required><label class="form-check-label" for="siswaL">Laki-laki</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="siswaP" name="jenis_kelamin" value="P" <?= (($detail['jenis_kelamin'] ?? '') === 'P') ? 'checked' : '' ?>>
            <label class="form-check-label" for="siswaP">Perempuan</label></div>
          </div>
          <input type="hidden" name="id_siswa" value="<?= e($detail['id'] ?? '') ?>">
        <?php else: ?>
          <hr><h2 class="section-title mb-3">Data Profil Admin</h2>
          <div class="alert alert-info mb-0">Untuk Admin, halaman ini mengubah username dan password. Nama admin ditampilkan dari session karena struktur tabel khusus admin belum terlihat pada file yang diberikan.</div>
        <?php endif; ?>

        <input type="hidden" name="role" value="<?= e($role) ?>">
        <input type="hidden" name="id_user" value="<?= e($userId) ?>">
        <div class="d-flex flex-wrap gap-2 mt-4">
          <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
          <a href="profile.php" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>
      <p class="small text-secondary mt-4 mb-0">Catatan: form ini menggunakan <code>proses_edit.php</code> yang sudah ada. Pastikan proses tersebut mendukung update profil sendiri berdasarkan ID session dan menyimpan password dengan hash.</p>
    </div>
  </div>
</main>
</body>
</html>
