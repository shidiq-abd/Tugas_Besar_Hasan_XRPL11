<?php

require 'koneksi.php';
session_start();


$username= $_POST['username'];
$password = $_POST['password'];

// $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
// $result = mysqli_query($koneksi, $query);

// if (mysqli_num_rows($result) > 0) {
//     session_start();
//     $_SESSION['username'] = $username;
//     header("Location: dashboard.php");
// } else {
//     echo "<script> alert('Username atau Password salah !');
//     Window.location='form_login.php';
//     </script>";
// }

$sql = "SELECT users.*, coalesce(siswa.nama, guru.nama) AS nama, siswa.kelas 
        FROM users 
        LEFT JOIN siswa ON users.id = siswa.user_id 
        LEFT JOIN guru ON users.id = guru.user_id 
        WHERE users.username = '$username'";


$result = mysqli_fetch_assoc(mysqli_query($koneksi, $sql));

if ($result && password_verify($password, $result['password'])) {
    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['role'] = $result['role'];
    $_SESSION['nama'] = $result['nama'];
    $_SESSION['kelas'] = $result['kelas'];
    $_SESSION['login'] = true;
    header("Location: index.php");
    exit;
}else{
    echo "<script> alert('Username atau Password salah !');
    window.location='form_login.php';
    </script>";
}

?>