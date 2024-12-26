<?php
session_start();
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
          $user = $_POST['user'];
          $pass = $_POST['pass'];
          $user = mysqli_real_escape_string($koneksi, $user);
          $pass = mysqli_real_escape_string($koneksi, $pass);
          $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' AND password='$pass' ");
          $row = mysqli_fetch_array($data);
          if (mysqli_num_rows($data)> 0) {
                    $_SESSION['username'] = $row['username'];
                    header("location: ../dashboard/dashboard.php");
                    exit();
          } else {
                    $error ="username atau password salah";
          }
}
?>
