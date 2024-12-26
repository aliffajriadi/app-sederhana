<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = mysqli_real_escape_string($koneksi, $_POST['user']);
    $password = $_POST['pass'];

    // Query untuk mendapatkan user berdasarkan username
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Simpan role di session
        header("Location: ../dashboard/dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah.";
        echo "<script>alert('berhasil');</script>";

    }
}
?>