<?php
require 'koneksi.php';
require_once 'navbar.php';

$sql = "SELECT mengajar.id, siswa.kelas, guru.nama AS nama_guru,
               mapel.nama_mapel, mapel.kode_mapel, siswa.nama AS nama_siswa
        FROM mengajar
        JOIN siswa ON mengajar.siswa_id = siswa.id
        JOIN mapel ON mengajar.mapel_id = mapel.id
        JOIN guru ON mapel.guru_id = guru.id
        ORDER BY mengajar.id DESC";

$query = mysqli_query($koneksi, $sql);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white p-4">
            <h1 class="h4 mb-1">Daftar Mengajar</h1>
            <p class="text-secondary mb-0">Daftar mata pelajaran yang diajarkan pada setiap kelas.</p>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Kelas</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kode Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ($query && mysqli_num_rows($query) > 0) { ?>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama_guru']); ?></td>
                                <td><?= htmlspecialchars($row['kelas']); ?></td>
                                <td><?= htmlspecialchars($row['nama_mapel']); ?></td>
                                <td><?= htmlspecialchars($row['kode_mapel']); ?></td>
                                <td>
                                    <a href="form_edit_mengajar.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="proses_mengajar.php" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data mengajar untuk siswa ini?');">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <input type="hidden" name="aksi" value="hapus">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada data mengajar.</td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
