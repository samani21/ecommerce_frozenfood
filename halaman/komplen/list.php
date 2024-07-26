<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM komplen");
?>
<div>
    <a href="index.php?page=tambah_komplen" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td>
                        <a href="index.php?page=edit_komplen&id=<?= $row['id_komplen'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_komplen&id=<?= $row['id_komplen'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>