<?php
include '../dashboard/koneksi.php';

// Ambil data dari form
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

// Cek apakah file baru diunggah untuk foto
if (isset($_FILES["foto"]["name"]) && $_FILES['foto']['name'] != '') {
    $foto = $_FILES['foto']['name'];
    $targetFoto = "uploads/" . basename($foto);

    // Upload file baru
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFoto)) {
        // Hapus foto lama jika ada
        $queryFoto = mysqli_query($koneksi, "SELECT foto FROM calon_mhs WHERE nis = '$nis'");
        $oldFoto = mysqli_fetch_assoc($queryFoto)['foto'];

        if ($oldFoto && file_exists("uploads/$oldFoto")) {
            unlink("uploads/$oldFoto");
        }
    } else {
        echo "Gagal mengunggah foto.";
        exit;
    }
} else {
    // Jika tidak ada file baru, tetap gunakan foto lama
    $queryFoto = mysqli_query($koneksi, "SELECT foto FROM calon_mhs WHERE nis = '$nis'");
    $foto = mysqli_fetch_assoc($queryFoto)['foto'];
}

// Cek apakah file baru diunggah untuk file pendukung
if (isset($_FILES['file_pendukung']['name']) && $_FILES['file_pendukung']['name'] != '') {
    $filePendukung = $_FILES['file_pendukung']['name'];
    $targetFilePendukung = "uploads/" . basename($filePendukung);

    // Upload file baru
    if (move_uploaded_file($_FILES['file_pendukung']['tmp_name'], $targetFilePendukung)) {
        // Hapus file lama jika ada
        $queryFilePendukung = mysqli_query($koneksi, "SELECT file_pendukung FROM calon_mhs WHERE nis = '$nis'");
        $oldFilePendukung = mysqli_fetch_assoc($queryFilePendukung)['file_pendukung'];

        if ($oldFilePendukung && file_exists("uploads/$oldFilePendukung")) {
            unlink("uploads/$oldFilePendukung");
        }
    } else {
        echo "Gagal mengunggah file pendukung.";
        exit;
    }
} else {
    // Jika tidak ada file baru, tetap gunakan file pendukung lama
    $queryFilePendukung = mysqli_query($koneksi, "SELECT file_pendukung FROM calon_mhs WHERE nis = '$nis'");
    $filePendukung = mysqli_fetch_assoc($queryFilePendukung)['file_pendukung'];
}

// Perbarui data di database
$queryUpdate = "UPDATE calon_mhs SET
    nama = '$nama',
    jk = '$jk',
    telepon = '$telepon',
    alamat = '$alamat',
    foto = '$foto',
    file_pendukung = '$filePendukung'
WHERE nis = '$nis'";

if (mysqli_query($koneksi, $queryUpdate)) {
    echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
    header("Location: index.php?status=success"); // Redirect ke halaman utama dengan status berhasil
} else {
    echo "Gagal memperbarui data: " . mysqli_error($koneksi);
}
