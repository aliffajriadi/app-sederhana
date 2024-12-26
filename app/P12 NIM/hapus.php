<?php
include '../dashboard/koneksi.php'; 

$nis = $_GET['nis'];

// Ambil data untuk NIS yang diberikan
$query = mysqli_query($koneksi, "SELECT * FROM calon_mhs WHERE nis = '$nis'");
$data = mysqli_fetch_assoc($query);

// Cek apakah data ditemukan
if ($data) {
    // Cek jika 'foto' adalah file sebelum mencoba menghapusnya
    $fotoPath = "uploads/" . $data['foto'];
    if (file_exists($fotoPath) && !is_dir($fotoPath)) {
        unlink($fotoPath);
    }

    // Cek jika 'file_pendukung' adalah file sebelum mencoba menghapusnya
    $filePendukungPath = "uploads/" . $data['file_pendukung'];
    if (file_exists($filePendukungPath) && !is_dir($filePendukungPath)) {
        unlink($filePendukungPath);
    }

    // Hapus data dari database
    mysqli_query($koneksi, "DELETE FROM calon_mhs WHERE nis = '$nis'");

    echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Data tidak ditemukan'); window.location='index.php';</script>";
}
?>
