<?php
include 'koneksi.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$bagian = $_POST['bagian'];
$result = mysqli_query($koneksi, "UPDATE pegawai SET nama='$nama', bagian='$bagian' WHERE nik='$nik'");
header("location: pegawai.php")
?>