<?php
include "././koneksi.php";
$id_pel = $_SESSION['id'];
$level = $_SESSION['level'];
if ($_SESSION['level'] == "Admin") {
    $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl as tgl FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir`");
} else {
    $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl as tgl FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE pelanggan.id_user = $id_pel");
}
?>
<div>
    <form action="halaman/history/cetak.php" method="get">
        <div class="row">
            <div class="col-2">Cetak Periode</div>
            <div class="col-3">
                <input type="date" name="dari" class="form-control">
            </div>
            <div class="col-3">
                <input type="date" name="sampai" class="form-control">
            </div>
            <input type="hidden" name="id_pel" value="<?= $id_pel ?>" class="form-control">
            <input type="hidden" name="level" value="<?= $level ?>" class="form-control">
            <div class="col-1">
                <button class="btn btn-primary" type="submit">Cetak</button>
            </div>
        </div>
    </form>
</div>
<br>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Ongkir</th>
                <th>Harga</th>
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
                    <td><?= $row['tgl'] ?></td>
                    <td><?= $row['kota'] ?></td>
                    <td><?= $row['hrg'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>