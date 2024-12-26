<?php
include 'koneksi.php';

$nind = $_POST['nind'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$alamat = $_POST['alamat'];
$result = mysqli_query($koneksi, "UPDATE dosen SET nama='$nama', jabatan='$jabatan', alamat='$alamat' WHERE nind='$nind'");
header("location: dosen.php")
?>