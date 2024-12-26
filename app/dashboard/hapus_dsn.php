<?php
include '../session/koneksi.php';

$nind = $_GET['nind'];

$result = mysqli_query($koneksi,"DELETE FROM dosen WHERE nind = '$nind'");
header("Location:dosen.php")
?>