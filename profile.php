<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'koneksi.php';

$role = strtolower($_SESSION['role'] ?? '');
$userId = $_SESSION['id'] ?? $_SESSION['id_user'] ?? null;
$usernameSession = $_SESSION['username'] ?? 'Pengguna';
$namaSession = $_SESSION['nama'] ?? $usernameSession;

if (!$userId || !in_array($role, ['admin', 'guru', 'siswa'], true)) {
    header('Location: login.php');
    exit;
}

$username = $usernameSession;
$nama = $namaSession;
$roleTampil = ucfirst($role);
$detail = [];

$stmt = mysqli_prepare($koneksi, 'SELECT id, username, role FROM users WHERE id = ? LIMIT 1');
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($akun = mysqli_fetch_assoc($res)) {
        $username = $akun['username'] ?? $username;
        $roleTampil = ucfirst($akun['role'] ?? $role);
    }
    mysqli_stmt_close($stmt);
}

if ($role === 'guru') {
    $stmt = mysqli_prepare($koneksi, 'SELECT nip, nama, jenis_kelamin FROM guru WHERE user_id = ? LIMIT 1');
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $detail = mysqli_fetch_assoc($res) ?: [];
        mysqli_stmt_close($stmt);
    }
    $nama = $detail['nama'] ?? $nama;
} elseif ($role === 'siswa') {
    $stmt = mysqli_prepare($koneksi, 'SELECT nis, nama, kelas, jenis_kelamin FROM siswa WHERE user_id = ? LIMIT 1');
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $detail = mysqli_fetch_assoc($res) ?: [];
        mysqli_stmt_close($stmt);
    }
    $nama = $detail['nama'] ?? $nama;
} else {
    $nama = $namaSession;
}

function e($value) {
    return htmlspecialchars((string)($value ?? '-'), ENT_QUOTES, 'UTF-8');
}
$initial = strtoupper(substr(trim($nama ?: 'P'), 0, 1));
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile - SIPN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#fff;color:#172033}
    .profile-wrap{max-width:770px;margin:26px auto}
    .page-subtitle{color:#68758a}
    .profile-card{border:1px solid #f1f3f6;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,.035);overflow:hidden}
    .profile-hero{text-align:center;padding:24px 20px}
    .avatar{width:90px;height:90px;border-radius:50%;background:#0d6efd;color:#fff;display:flex;align-items:center;justify-content:center;font-size:38px;font-weight:400;margin:0 auto 14px}
    .section{padding:18px 17px;border-top:1px solid #dce1e8}
    .section h2{font-size:20px;font-weight:700;margin-bottom:24px}
    .info-row{display:grid;grid-template-columns: minmax(130px, 1fr) minmax(180px, 2fr);gap:16px;margin:17px 0}
    .info-label{color:#68758a}
    .badge-role{font-size:12px;letter-spacing:.3px}
    @media(max-width:576px){.profile-wrap{margin:20px 12px}.info-row{grid-template-columns:1fr;gap:4px}}
  </style>
</head>
<body>
<main class="container profile-wrap">
  <h1 class="h3 fw-bold mb-1">Profile</h1>
  <p class="page-subtitle mb-4">Informasi akun yang sedang login</p>

  <section class="profile-card">
    <div class="profile-hero">
      <div class="avatar"><?= e($initial) ?></div>
      <h2 class="h4 fw-bold mb-1"><?= e($nama) ?></h2>
      <span class="badge text-bg-primary badge-role"><?= e(strtoupper($role)) ?></span>
    </div>

    <div class="section">
      <h2>Informasi Akun</h2>
      <div class="info-row">
        <div class="info-label">Username</div>
        <div class="fw-semibold"><?= e($username) ?></div>
      </div>
      <div class="info-row">
        <div class="info-label">Role</div>
        <div><span class="badge text-bg-danger"><?= e($roleTampil) ?></span></div>
      </div>
    </div>

    <div class="section">
      <h2>Data <?= e($roleTampil) ?></h2>
      <?php if ($role === 'admin'): ?>
        <div class="info-row">
          <div class="info-label">Nama</div>
          <div class="fw-semibold"><?= e($nama) ?>
        </div></div>
      <?php elseif ($role === 'guru'): ?>
        <div class="info-row">
          <div class="info-label">NIP</div>
          <div class="fw-semibold"><?= e($detail['nip'] ?? '-') ?>
        </div></div>
        <div class="info-row">
          <div class="info-label">Nama</div>
          <div class="fw-semibold"><?= e($detail['nama'] ?? '-') ?>
        </div></div>
        <div class="info-row">
          <div class="info-label">Jenis Kelamin</div>
          <div class="fw-semibold"><?= e(($detail['jenis_kelamin'] ?? '') === 'L' ? 'Laki-laki' : (($detail['jenis_kelamin'] ?? '') === 'P' ? 'Perempuan' : '-')) ?>
        </div></div>
      <?php else: ?>
        <div class="info-row">
          <div class="info-label">NIS</div>
          <div class="fw-semibold"><?= e($detail['nis'] ?? '-') ?>
        </div></div>
        <div class="info-row">
          <div class="info-label">Nama</div>
          <div class="fw-semibold"><?= e($detail['nama'] ?? '-') ?></div></div>
        <div class="info-row">
          <div class="info-label">Kelas</div>
          <div class="fw-semibold"><?= e($detail['kelas'] ?? '-') ?></div></div>
        <div class="info-row">
          <div class="info-label">Jenis Kelamin</div>
          <div class="fw-semibold"><?= e(($detail['jenis_kelamin'] ?? '') === 'L' ? 'Laki-laki' : (($detail['jenis_kelamin'] ?? '') === 'P' ? 'Perempuan' : '-')) ?></div></div>
      <?php endif; ?>
    </div>

    <div class="section d-flex flex-wrap gap-2">
      <a href="form_edit.php" class="btn btn-primary">Edit Profile</a>
      <?php if ($role === 'admin'): ?>
        <a href="daftar_user.php" class="btn btn-primary">Kembali ke Dashboard</a>
      <?php elseif ($role === 'guru'): ?>
        <a href="dashboard_guru.php" class="btn btn-primary">Kelmbali ke Dasboard</a>
      <?php else: ?>
        <a href="dashboard_siswa.php" class="btn btn-primary">Kembali ke Dashboard</a>
        <?php endif; ?>
    </div>
  </section>
</main>
</body>
</html>
