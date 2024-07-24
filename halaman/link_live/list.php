<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM link");
?>
<div>
    <a href="index.php?page=tambah_link_live" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama live/video</th>
                <th>link</th>
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
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['link'] ?></td>
                    <td>
                        <a href="index.php?page=edit_link_live&id=<?= $row['id_link'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_link_live&id=<?= $row['id_link'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>