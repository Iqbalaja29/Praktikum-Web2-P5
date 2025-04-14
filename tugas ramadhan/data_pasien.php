<?php
require_once 'dbkoneksi.php';

$sql = "SELECT pasien.*, kelurahan.nama AS kelurahan_nama FROM pasien 
        LEFT JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id";
$rs = $dbh->query($sql);
?>

<!-- CSS Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<div class="container mt-5">
  <h2>Data Pasien</h2>
  <a href="form_pasien.php" class="btn btn-primary mb-3">Tambah Pasien</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Kelurahan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($rs as $row): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['kode']) ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['tmp_lahir']) ?></td>
          <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
          <td><?= htmlspecialchars($row['gender']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['alamat']) ?></td>
          <td><?= htmlspecialchars($row['kelurahan_nama']) ?></td>
          <td>
            <a href="form_pasien.php?id=<?= $row['id'] ?>&idx=<?= $no-1 ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="proses_pasien.php?proses=Hapus&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
