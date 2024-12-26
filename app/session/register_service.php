<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);
    
    $hashed_password = password_hash($password ,PASSWORD_DEFAULT);
    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script> alert('registrasi berhasil'); window.location='../'; </script>";

    } else {
        echo "<script> alert('Registrasi Gagal: " . mysqli_error($koneksi) . "'); window.history.back(); </script>";
    }

}
?>