<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM ongkir WHERE NOT id_ongkir =1");
?>
<div>
    <a href="index.php?page=tambah_ongkir" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kecamatan</th>
                <th>Kurir</th>
                <th>Harga</th>
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
                    <td><?= $row['kota'] ?></td>
                    <td><?= $row['kurir'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['harga'], 0, ',', '.') ?></td>
                    <td>
                        <a href="index.php?page=edit_ongkir&id=<?= $row['id_ongkir'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_ongkir&id=<?= $row['id_ongkir'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>