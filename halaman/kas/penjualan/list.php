<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM penjualan");
?>
<div>
    <a href="index.php?page=tambah_penjualan" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
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
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        if (!$row['acc'] == 1) {
                        ?>
                            <a href="index.php?page=edit_penjualan&id=<?= $row['id_penjualan'] ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?page=hapus_penjualan&id=<?= $row['id_penjualan'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                            <a href="index.php?page=verifikasi_penjualan&id=<?= $row['id_penjualan'] ?>" class="btn btn-success" onclick="return confirm('Apakah data sudah benar ?')">ACC</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>