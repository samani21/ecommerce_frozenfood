<?php
include "././koneksi.php";
$id_pel = $_SESSION['id'];
if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == " Super Admin") {
    $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl AS tgl_order,komplen.deskripsi,komplen.status_retur,komplen.bukti FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` LEFT JOIN komplen ON `order`.id_order = komplen.id_order ORDER BY order.tgl DESC");
} else {
    $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl AS tgl_order,komplen.deskripsi,komplen.status_retur,komplen.bukti FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` LEFT JOIN komplen ON `order`.id_order = komplen.id_order WHERE pelanggan.id_user = $id_pel ORDER BY order.tgl DESC");
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
                <th>Komplen</th>
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
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tgl_order'] ?></td>
                    <td><?= $row['kota'] ?></td>
                    <td><?php
                        if (isset($row['deskripsi'])) {
                        ?>

                            <div>
                                <?= $row['deskripsi'] ?>
                            </div>
                            <div>
                                <?php if (substr($row['bukti'], -3) == "mp4") {
                                ?>
                                    <video width="200" height="200" controls>
                                        <source src="http://localhost/bikafrozen/file/<?= $row['bukti'] ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php
                                } else {
                                ?>
                                    <img src="http://localhost/bikafrozen/file/<?= $row['bukti'] ?>" width="100" height="100" alt="">
                                <?php
                                } ?>
                            </div>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['hrg'], 0, ',', '.') ?></td>
                    <td>
                        <a href="index.php?page=menu&id_order=<?= $row['id_order'] ?>" class="btn btn-warning">Cek</a>
                        <?php
                        if ($row['deskripsi'] && $row['status_retur'] == 0 && $_SESSION['level'] == "Admin" || $row['deskripsi'] && $row['status_retur'] == 0 && $_SESSION['level'] == "Super Admin") {
                        ?>
                            <a href="index.php?page=retur&id_order=<?= $row['id_order'] ?>&status=1" class="btn btn-primary">Retur Barang</a>
                            <a href="index.php?page=retur&id_order=<?= $row['id_order'] ?>&status=2" class="btn btn-primary">Retur Uang</a>
                        <?php
                        } else if ($row['deskripsi'] && $row['status_retur'] == 1) {
                        ?>
                            <span class="badge bg-primary">Diganti Barang</span>
                        <?php
                        } else if ($row['deskripsi'] && $row['status_retur'] == 2) {
                        ?>
                            <span class="badge bg-success">Uang kembali</span>
                        <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
                            if ($row['pembayaran'] == 3 || $row['pembayaran'] == 4) {
                            } else {
                        ?>
                                <a href="index.php?page=bayar&id_order=<?= $row['id_order'] ?>" class="btn btn-success">Dikirim</a>
                                <a href="index.php?page=hapus_history&id_order=<?= $row['id_order'] ?>" class="btn btn-danger">Hapus</a>
                            <?php
                            }
                        }
                        if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "Super Admin") {
                            if ($row['pembayaran'] == 3) {
                            ?>
                                <a href="index.php?page=terima&id_order=<?= $row['id_order'] ?>" class="btn btn-primary">Terima</a>
                        <?php
                            } else {
                            }
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