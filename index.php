<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: form_login.php");
    exit;
}

$role = $_SESSION['role'] ?? '';

switch ($role) {
    case 'admin':
        header("location: daftar_user.php");
        exit;
    case 'siswa':
        header("location: dashboard_siswa.php");
        exit;
    case 'guru':
        header("location: dashboard_guru.php");
        exit;
    default:
        session_destroy();
        header("location: form_login.php");
        exit;
}
?>