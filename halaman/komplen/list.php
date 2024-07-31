<?php
include "././koneksi.php";
$id_pel = $_SESSION['id'];
if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
    $query = mysqli_query($koneksi, "SELECT `order`.id_order,pelanggan.nama,`order`.tgl as tgl_order,ongkir.kota,komplen.status_retur,`order`.harga as hrg,komplen.deskripsi FROM `komplen` JOIN `order` ON `order`.`id_order` = `komplen`.`id_order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` ORDER BY `order`.tgl DESC");
} else {
    $query = mysqli_query($koneksi, "SELECT `order`.id_order,pelanggan.nama,`order`.tgl as tgl_order,ongkir.kota,komplen.status_retur,`order`.harga as hrg,komplen.deskripsi FROM `komplen` JOIN `order` ON `order`.`id_order` = `komplen`.`id_order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE pelanggan.id_user = $id_pel ORDER BY order.tgl DESC");
}
?>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Ongkir</th>
                <th>Harga</th>
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
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tgl_order'] ?></td>
                    <td><?= $row['kota'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['hrg'], 0, ',', '.') ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td>
                        <a href="index.php?page=menu&id_order=<?= $row['id_order'] ?>" class="btn btn-warning">Cek</a>
                        <?php
                        if ($row['status_retur'] == 0 && $_SESSION['level'] == "Admin" || $row['status_retur'] == 0 && $_SESSION['level'] == "Super Admin") {
                        ?>
                            <a href="index.php?page=retur&id_order=<?= $row['id_order'] ?>&status=1" class="btn btn-primary">Retur Barang</a>
                        <?php
                        } else if ($row['status_retur'] == 1) {
                        ?>
                            <span class="badge bg-primary">Barang diganti dan sedang dikirim</span>
                            <a href="index.php?page=retur&id_order=<?= $row['id_order'] ?>&status=2" class="btn btn-success">Terima Barang</a>
                        <?php
                        } else if ($row['status_retur'] == 2) {
                        ?>
                            <span class="badge bg-success">Barang baru diterima</span>
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