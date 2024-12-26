<?php
include 'koneksi.php';


$nind = $_POST['nind'];
$nama = $_POST['nama'];  
$jabatan = $_POST['jabatan'];
$alamat = $_POST['alamat'];


$input = mysqli_query($koneksi, "INSERT INTO dosen (nind, nama, jabatan, alamat) VALUES ('$nind', '$nama', '$jabatan', '$alamat')") or die(mysqli_error($koneksi));


if ($input) {
    echo "<script>
    alert('Data Berhasil Disimpan');
    window.location.href = 'dosen.php';
    </script>";
} else {
    echo "<script>
    alert('Gagal Menyimpan Data');
    window.location.href = 'dosen.php';
    </script>";
}
?>
