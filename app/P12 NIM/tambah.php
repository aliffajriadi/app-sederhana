<?php
include '../dashboard/koneksi.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

// Validasi file gambar
$foto = $_FILES['foto']['name'];
$ukuran_foto = $_FILES['foto']['size'];
$tmp_foto = $_FILES['foto']['tmp_name'];
$ekstensi_foto_diperbolehkan = array('jpg', 'jpeg', 'png');
$x_foto = explode('.', $foto);
$ekstensi_foto = strtolower(end($x_foto));

// Validasi file dokumen (file pendukung)
$file_pendukung = $_FILES['file_pendukung']['name'];
$ukuran_file_pendukung = $_FILES['file_pendukung']['size'];
$tmp_file_pendukung = $_FILES['file_pendukung']['tmp_name'];
$ekstensi_file_diperbolehkan = array('pdf', 'doc', 'docx');
$x_file_pendukung = explode('.', $file_pendukung);
$ekstensi_file_pendukung = strtolower(end($x_file_pendukung));

// Validasi ekstensi dan ukuran file
if (in_array($ekstensi_foto, $ekstensi_foto_diperbolehkan) && $ukuran_foto <= 9000000) {
    if (in_array($ekstensi_file_pendukung, $ekstensi_file_diperbolehkan) && $ukuran_file_pendukung <= 9000000) {
        // Generate unique file names
        $foto_baru = uniqid() . '.' . $ekstensi_foto;
        $path_foto = "uploads/" . $foto_baru;

        $file_pendukung_baru = uniqid() . '.' . $ekstensi_file_pendukung;
        $path_file_pendukung = "uploads/" . $file_pendukung_baru;

        // Upload files
        if (move_uploaded_file($tmp_foto, $path_foto) && move_uploaded_file($tmp_file_pendukung, $path_file_pendukung)) {
            // Prepare query to prevent SQL injection
            $query = $koneksi->prepare("INSERT INTO calon_mhs (`nis`, `nama`, `jk`, `telepon`, `alamat`, `foto`, `file_pendukung`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param("sssssss", $nis, $nama, $jk, $telepon, $alamat, $foto_baru, $file_pendukung_baru);
            
            if ($query->execute()) {
                echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data ke database!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Gagal mengunggah file!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('File dokumen tidak valid atau ukurannya terlalu besar!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('File gambar tidak valid atau ukurannya terlalu besar!'); window.history.back();</script>";
}
?>
