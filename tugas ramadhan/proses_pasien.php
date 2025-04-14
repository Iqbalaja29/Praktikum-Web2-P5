<?php
require_once 'dbkoneksi.php';

// Tangkap aksi dari tombol
$proses = $_POST['proses'] ?? $_GET['proses'] ?? '';

if ($proses == 'Simpan') {
    $data = [
        $_POST['kode'],
        $_POST['nama'],
        $_POST['tmp_lahir'],
        $_POST['tgl_lahir'],
        $_POST['gender'],
        $_POST['email'],
        $_POST['alamat'],
        $_POST['kelurahan_id']
    ];

    if (isset($_POST['idx'])) {
        // Update
        $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, kelurahan_id=? WHERE id=?";
        $data[] = $_POST['idx'];
    } else {
        // Insert
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    }

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    
    header("Location: data_pasien.php");
    exit;

} elseif ($proses == 'Hapus') {
    $id = $_GET['id'];
    $sql = "DELETE FROM pasien WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);

    header("Location: data_pasien.php");
    exit;
}
?>
