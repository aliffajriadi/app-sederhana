<?php
include '../session/koneksi.php';

$nim = $_GET['nim'];

$result = mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE nim = '$nim'");
header("Location:mahasiswa.php")
?>