<?php
include "././koneksi.php";
$id_pel = $_SESSION['id'];
if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
    $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl AS tgl_order,komplen.deskripsi,komplen.status_retur,komplen.bukti,user.email FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` LEFT JOIN komplen ON `order`.id_order = komplen.id_order JOIN user ON pelanggan.id_user = user.id ORDER BY order.tgl DESC");
} else {
    $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl AS tgl_order,komplen.deskripsi,komplen.status_retur,komplen.bukti,user.email FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` LEFT JOIN komplen ON `order`.id_order = komplen.id_order JOIN user ON pelanggan.id_user = user.id WHERE pelanggan.id_user = $id_pel ORDER BY order.tgl DESC");
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
                    <td>
                        <a href="index.php?page=menu&id_order=<?= $row['id_order'] ?>" class="btn btn-warning">Cek</a>
                        <?php
                        if ($row['deskripsi'] && $row['status_retur'] == 1) {
                        ?>
                            <span class="badge bg-primary">Diganti Barang</span>
                        <?php
                        } else if ($row['deskripsi'] && $row['status_retur'] == 2) {
                        ?>
                            <span class="badge bg-success">Barang baru diterima</span>
                        <?php
                        }
                        ?>
                        <?php
                        if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
                            if ($row['pembayaran'] == 3 || $row['pembayaran'] == 4) {
                                if ($row['pembayaran'] == 4) {
                        ?>
                                    <span class="badge bg-success">Pesanan Diterima</span>
                                <?php
                                }
                            } else if ($row['pembayaran'] == 2) {
                                ?>
                                <a href="index.php?page=bayar&id_order=<?= $row['id_order'] ?>&email=<?= $row['email'] ?>" class="btn btn-success">Dikirim</a>
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