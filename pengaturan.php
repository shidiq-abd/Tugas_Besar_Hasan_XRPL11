<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$role = strtolower($_SESSION['role'] ?? '');
if (!in_array($role, ['admin', 'guru', 'siswa'], true)) {
    header('Location: login.php');
    exit;
}
// Pengaturan akun diarahkan ke form edit profil milik pengguna yang sedang login.
header('Location: form_edit.php');
exit;
?>
