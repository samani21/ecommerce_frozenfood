<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM kurir");
?>
<div>
    <a href="index.php?page=tambah_kurir" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kurir</th>
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
                    <td><?= $row['kurir'] ?></td>
                    <td>
                        <a href="index.php?page=edit_kurir&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_kurir&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>