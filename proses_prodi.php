<?php
require_once 'dbkoneksi.php'

// 1) tangkap data dari form
$_kode = $_POST['kode'];
$_nama = $_POST['nama'];
$_kaprodi = $_POST['kaprodi'];
$_proses = $_POST['proses'];

// buat array data
$ar_data = [$_kode,$_nama,$_kaprodi];

// 4) buat query
if($_proses == 'simpan'){
    $sql = "INSERT INTO prodi(kode,nama.kaprodi) VALUES(?,?,?)";
}elseif($_proses == 'update'){
    $id_edit = $_POST['id_edit'];//4
    $ar_data[] = $id_edit;
    $sql = "UPDATE prodi SET kode=?,nama=?,kaprodi=? WHERE id=?";
}elseif($_proses == 'hapus'){
    $id_hapus = $_POST['id_hapus'];
    $ar_data = [$id_hapus];
    $sql = "DELETE FROM prodi WHERE id=?";
}

// 5) buat statement
$stmt = $dbh->prepare($sql);

// 6) jalankan query
$stmt->execute($ar_data);

// redirect ke halaman list_prodi.php
header('Location:list_prodi.php');
?>