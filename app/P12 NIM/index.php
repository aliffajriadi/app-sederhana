<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to top right, rgb(171, 217, 255), white);
            height: 100vh;
        }
    </style>
</head>

<body class="h-100vh">
    <div class="container mt-5">
        <h2 class="text-center">Data Calon Mahasiswa</h2>
        <div class="d-flex justify-content-center mt-5">
            <button class="btn btn-primary mb-3 justify-items-end" data-bs-toggle="modal" data-bs-target="#addModal">Tambah data</button>
        </div>
        <table class="table table-bordered table-primary">
            <thead class="table-success">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>File Pendukung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../dashboard/koneksi.php';
                $query = mysqli_query($koneksi, "SELECT * FROM calon_mhs");
                while ($data = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?php echo $data['nis']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jk']; ?></td>
                        <td><?php echo $data['telepon']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><img src="uploads/<?php echo $data['foto']; ?>" alt="Foto" width="100"></td>
                        <td><a href="uploads/<?php $data['file_pendukung']; ?>" target="_blank">Download</a></td>
                        <td>
                            <button class="btn btn-warning btn-edit"
                                data-nis="<?php echo $data['nis']; ?>"
                                data-nama="<?php echo $data['nama']; ?>"
                                data-jk="<?php echo $data['jk']; ?>"
                                data-telepon="<?php echo $data['telepon']; ?>"
                                data-alamat="<?php echo $data['alamat']; ?>"
                                data-foto="<?php echo $data['foto']; ?>"
                                data-file_pendukung="<?php echo $data['file_pendukung']; ?>">
                                Edit
                            </button>

                            <a href="hapus.php?nis=<?php echo $data['nis']; ?>" class="btn btn-danger" onclick="return confirm('Yakin mmau hapus?')">Hapus</a>
                        </td>
                    </tr>


                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="tambah.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-select" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <div class="mb-3">
                            <label for="file_pendukung" class="form-label">File Pendukung</label>
                            <input type="file" class="form-control" id="file_pendukung" name="file_pendukung" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="ubah.php" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editNis" name="nis">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="editJk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="editJk" name="jk" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label for="editTelepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="editTelepon" name="telepon" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="editAlamat" name="alamat" required></textarea>
                        </div>

                        <!-- Foto -->
                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label><br>
                            <img id="editFotoPreview" src="" alt="Foto" width="150" class="mb-3 border rounded"><br>
                            <label for="editFoto" class="form-label">Ganti Foto</label>
                            <input type="file" class="form-control" id="editFoto" name="foto">
                        </div>

                        <!-- File Pendukung -->
                        <div class="mb-3">
                         
                            <label for="editFilePendukung" class="form-label">Ganti File Pendukung</label>
                            <input type="file" class="form-control" id="editFilePendukung" name="file_pendukung">
                            <label class="form-label mt-2">File Pendukung Saat Ini</label><br>
                            <a id="editFilePreview" href="#" target="_blank" class="btn btn-primary mb-3">Lihat File</a><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Menunggu event ketika modal edit dibuka
        document.addEventListener('DOMContentLoaded', function() {
            //
            const editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data-* tombol edit
                    const nis = this.getAttribute('data-nis');
                    const nama = this.getAttribute('data-nama');
                    const jk = this.getAttribute('data-jk');
                    const telepon = this.getAttribute('data-telepon');
                    const alamat = this.getAttribute('data-alamat');
                    const foto = this.getAttribute('data-foto');
                    const filePendukung = this.getAttribute('data-file_pendukung');

                    // Isi data ke dalam modal edit
                    document.getElementById('editNis').value = nis;
                    document.getElementById('editNama').value = nama;
                    document.getElementById('editJk').value = jk;
                    document.getElementById('editTelepon').value = telepon;
                    document.getElementById('editAlamat').value = alamat;
                    document.getElementById('editFotoPreview').src = 'uploads/' + foto;
                    document.getElementById('editFilePreview').href = 'uploads/' + filePendukung;

                    // Menampilkan modal edit
                    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                });
            });
        });
    </script>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>