<?php
require 'koneksi.php';
require_once 'navbar.php';

$id = (int) ($_GET['id'] ?? 0);
$sql = "SELECT mengajar.id, mengajar.mapel_id, siswa.kelas
        FROM mengajar
        JOIN siswa ON mengajar.siswa_id = siswa.id
        WHERE mengajar.id = $id LIMIT 1";
$result = mysqli_query($koneksi, $sql);
$data = $result ? mysqli_fetch_assoc($result) : null;
if (!$data) {
    echo "<script>alert('Data mengajar tidak ditemukan'); window.location.href='daftar_mengajar.php';</script>";
    exit();
}
$mapel_query = mysqli_query($koneksi, "SELECT mapel.id, mapel.nama_mapel, mapel.kode_mapel, guru.nama AS nama_guru FROM mapel JOIN guru ON mapel.guru_id = guru.id ORDER BY guru.nama ASC, mapel.nama_mapel ASC");
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Edit Mengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5"><div class="row justify-content-center">
    <div class="col-12 col-md-9 col-lg-7">
      <div class="card border-0 shadow-sm">
       <div class="card-header bg-white p-4">
       <h1 class="h4 mb-0">Form Edit Mengajar</h1></div>
        <div class="card-body p-4">
          <form action="proses_mengajar.php" method="POST">
          <input type="hidden" name="aksi" value="edit">
          <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="mb-3">
          <label class="form-label">Kelas</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($data['kelas']); ?>" readonly>
        <div class="form-text">Kelas mengikuti data siswa pada database.</div>
      </div>
        <div class="mb-4">
          <label for="mapel_id" class="form-label">Pilih Guru / Mata Pelajaran</label>
          <select name="mapel_id" id="mapel_id" class="form-select" required>
         <option value="">Pilih Guru...</option>
<?php while ($mapel = mysqli_fetch_assoc($mapel_query)) { ?>
<option value="<?= $mapel['id']; ?>" 
<?= ((int)$mapel['id'] === (int)$data['mapel_id']) ? 'selected' : ''; ?>>
<?= htmlspecialchars($mapel['nama_guru'] . ' | ' . $mapel['nama_mapel'] . ' (' . $mapel['kode_mapel'] . ')'); ?></option>
<?php } ?>
          </select>
      </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button> <a href="daftar_mengajar.php" class="btn btn-secondary">Kembali</a>
          </form>
        </div>
     </div>
  </div>
</div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></body></html>
