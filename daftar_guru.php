
<?php
require_once 'koneksi.php';
require_once 'navbar.php';

$sql =
    "SELECT guru.*, users.username
    FROM guru
    JOIN users ON guru.user_id = users.id
    ORDER BY guru.id DESC";

$query = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Data Guru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<main class="container py-5">
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h2 class="h4 mb-1">Daftar Data Guru</h2>
                    <p class="text-secondary mb-0">
                        Data guru yang terdaftar di sistem.
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>Username Akun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($query && mysqli_num_rows($query) > 0) { ?>

                            <?php $no = 1; ?>

                            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <?= htmlspecialchars($row['nip']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['nama']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['jenis_kelamin']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($row['username']); ?>
                                    </td>

                                    <td>
                                        <a href="form_edit_user.php?id=<?= $row['user_id']; ?>&role=guru"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>

                                        <a href="hapus.php?id=<?= $row['id']; ?>&jenis=guru"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Yakin ingin menghapus data guru ini?');">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">
                                    Belum ada data guru.
                                </td>
                            </tr>

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