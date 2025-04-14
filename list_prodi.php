<?php 
require_once 'dbkoneksi.php';

// 4) definisikan query
$sql = "SELECT * FROM prodi";

// 5) Jalankan query
$rs = $dbh->query($sql);

// 6) tampilkan hasil query
?>
<table border="1" width="100%">
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Nama Prodi</th>
        <th>Kepala Prodi</th>
        <th>Aksi</th>
        </tr>
        <?php 
        $nomor = 1;
        foreach($rs as $row){
            ?>
            <tr>
                <td><?php echo $row['id_prodi']; ?></td>
                <td><?php echo $row['id_prodi']; ?></td>
                <td><?php echo $row['id_prodi']; ?></td>
                <td><?php echo $row['id_prodi']; ?></td>
                <td>
                    <a href="form_prodi.php?id_edit=<?php echo $row->id; ?>">Edit</a>
                    <a href="prodi.php?id_hapus=<?php echo $row->id; ?>">Hapus>
                </td>
        }