<?php
include "././koneksi.php";
$pa = $_GET['page'];
$query = mysqli_query($koneksi, "SELECT SUM(total) AS total ,pesanan.id_barang,nm_barang FROM `pesanan` JOIN barang ON barang.id_barang = pesanan.id_barang WHERE pesanan.tgl GROUP BY pesanan.id_barang ORDER BY total DESC");
?>
<div>
    <div class="col-9">
        <form action="halaman/laporan_penjualan/cetak.php" method="get">
            <div class="row">
                <input type="hidden" name="page" value="<?= $pa ?>" class="form-control" required>
                <div class="col-3">
                    <input type="date" class="form-control" name="dari" required>
                </div>
                <div class="col-3">
                    <input type="date" class="form-control" name="sampai" required>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">cetak</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<table id="example" class="table datatable" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama barang</th>
            <th>Total Terjual</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nm_barang'] ?></td>
                <td><?= $row['total'] ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>