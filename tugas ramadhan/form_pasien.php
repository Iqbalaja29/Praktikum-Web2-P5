<?php
require_once 'dbkoneksi.php';

// Tangkap data dari parameter GET
$id = $_GET['id'] ?? null;
$idx = $_GET['idx'] ?? null;
$patientData = null;

// Ambil data pasien jika id tersedia
if ($id) {
    $sql = "SELECT * FROM pasien WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $patientData = $stmt->fetch();
}

// Ambil data kelurahan
$sqlKelurahan = "SELECT id, nama FROM kelurahan";
$rs = $dbh->query($sqlKelurahan);
?>

<!-- CSS Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container mt-5">
  <form method="POST" action="proses_pasien.php">
    <?php if ($idx): ?>
      <input type="hidden" name="idx" value="<?= htmlspecialchars($idx) ?>">
    <?php endif; ?>

    <div class="form-group row">
      <label for="kode" class="col-4 col-form-label">Kode</label>
      <div class="col-8">
        <input id="kode" name="kode" type="text" class="form-control" value="<?= htmlspecialchars($patientData['kode'] ?? '') ?>" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="nama" class="col-4 col-form-label">Nama Lengkap</label>
      <div class="col-8">
        <input id="nama" name="nama" type="text" class="form-control" value="<?= htmlspecialchars($patientData['nama'] ?? '') ?>" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="tmp_lahir" class="col-4 col-form-label">Tempat Lahir</label>
      <div class="col-8">
        <input id="tmp_lahir" name="tmp_lahir" type="text" class="form-control" value="<?= htmlspecialchars($patientData['tmp_lahir'] ?? '') ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
      <div class="col-8">
        <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control" value="<?= htmlspecialchars($patientData['tgl_lahir'] ?? '') ?>">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-4">Jenis Kelamin</label>
      <div class="col-8">
        <div class="form-check form-check-inline">
          <input name="gender" type="radio" class="form-check-input" value="L" <?= (isset($patientData['gender']) && $patientData['gender'] == 'L') ? 'checked' : '' ?>>
          <label class="form-check-label">Laki-Laki</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="gender" type="radio" class="form-check-input" value="P" <?= (isset($patientData['gender']) && $patientData['gender'] == 'P') ? 'checked' : '' ?>>
          <label class="form-check-label">Perempuan</label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="email" class="col-4 col-form-label">Email</label>
      <div class="col-8">
        <input id="email" name="email" type="email" class="form-control" value="<?= htmlspecialchars($patientData['email'] ?? '') ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="alamat" class="col-4 col-form-label">Alamat</label>
      <div class="col-8">
        <textarea id="alamat" name="alamat" class="form-control"><?= htmlspecialchars($patientData['alamat'] ?? '') ?></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label for="kelurahan_id" class="col-4 col-form-label">Kelurahan</label>
      <div class="col-8">
        <select id="kelurahan_id" name="kelurahan_id" class="form-control">
          <option value="">-- Pilih Kelurahan --</option>
          <?php foreach($rs as $row): ?>
            <option value="<?= htmlspecialchars($row['id']) ?>" <?= (isset($patientData['kelurahan_id']) && $patientData['kelurahan_id'] == $row['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($row['nama']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <div class="offset-4 col-8">
        <button name="proses" value="Simpan" type="submit" class="btn btn-primary">Simpan</button>
        <button name="proses" value="Batal" type="submit" class="btn btn-secondary">Batal</button>
      </div>
    </div>
  </form>
</div>
