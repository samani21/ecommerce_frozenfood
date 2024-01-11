<?php
    include "././koneksi.php";
    $query = mysqli_query($koneksi,"SELECT * FROM supplier ");
?>
<div>
    <a href="index.php?page=tambah_supplier" class="btn btn-primary">Tambah</a>
</div>
<div>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Telpon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($row = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nm_supplier'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['kota'] ?></td>
                            <td><?= $row['telp'] ?></td>
                            <td>
                                <a href="index.php?page=edit_supplier&id=<?= $row['id_supplier']?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?page=hapus_supplier&id=<?= $row['id_supplier']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>