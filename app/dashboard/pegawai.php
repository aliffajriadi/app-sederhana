<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: ../session/login.php");
    exit();
}
$role = $_SESSION['role']
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/5.15.4/css/all.min.css">
    <title>ADMINISTRATOR DATA PEGAWAI</title>
    <style>
        .nav-link:hover {
            background-color: gold;
            color: white !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">SELAMAT DATANG <?php echo strtoupper($_SESSION['username']);?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto d-flex align-items-center">
                    <div class="icon">
                        <i class="fas fa-envelope-square me-3"></i>
                        <i class="fas fa-bell-slash me-3"></i>
                        <i class="fas fa-user-circle me-3"></i>
                        <i class="fas fa-sign-out-alt me-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="row g-0 mt-5">
        <!-- Sidebar -->
        <div class="col-md-2 bg-info mt-2 pt-4">
            <ul class="nav flex-column ms-3 mb-5">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <hr class="bg-secondary">
                </li>
                <?php if ($role == 'admin' || $role == 'mahasiswa'): ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="mahasiswa.php"><i class="fas fa-user-graduate me-2"></i>Daftar Mahasiswa</a>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?>

                <?php if ($role == 'admin' || $role == 'dosen'): ?> 
                <li class="nav-item">
                    <a class="nav-link text-white" href="dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Daftar Dosen</a>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?>

                <?php if ($role == 'admin' || $role == 'pegawai'): ?> 
                <li class="nav-item">
                    <a class="nav-link text-white" href="pegawai.php"><i class="fas fa-users me-2"></i>Daftar Pegawai</a>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-user-graduate me-2"></i> Daftar Pegawai</h3>
            <hr>
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                <i class="fas fa-plus-circle me-2"></i>TAMBAH DATA PEGAWAI
            </button>

            <!-- Modal Edit Data -->
            <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" ariahidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDataLabel">Edit Data Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="update_pgw.php" method="POST">
                                <input type="hidden" id="edit-nik" name="nik">
                                <div class="mb-3">
                                    <label for="edit-nama" class="form-label">Nama Pegawai</label>
                                    <input type="text" class="form-control" id="edit-nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-bagian" class="form-label">Bagian</label>
                                    <input type="text" class="form-control" id="edit-bagian" name="bagian" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataLabel">Tambah Data Pegawai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="tambah_pegawai.php" method="POST">
                                <div class="mb-3">
                                    <label for="nind" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama pegawai</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Bagian</label>
                                    <input type="text" class="form-control" id="bagian" name="bagian" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mahasiswa Table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NIK</th>
                        <th scope="col">NAMA PEGAWAI</th>
                        <th scope="col">BAGIAN</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM pegawai");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nik']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['bagian']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm me-1 edit-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDataModal"
                                    data-nik="<?php echo $data['nik']; ?>"
                                    data-nama="<?php echo $data['nama']; ?>"
                                    data-bagian="<?php echo $data['bagian']; ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <a href="hapus_pgw.php?nik=<?php echo $data['nik']; ?>" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>


                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nik = this.getAttribute('data-nik');
                    const nama = this.getAttribute('data-nama');
                    const bagian = this.getAttribute('data-bagian');

                    document.getElementById('edit-nik').value = nik;
                    document.getElementById('edit-nama').value = nama;
                    document.getElementById('edit-bagian').value = bagian;

                });
            });
        });
    </script>
</body>

</html>