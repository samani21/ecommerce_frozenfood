<?php
include "././koneksi.php";
@$dari = $_GET['dari'];
@$sampai = $_GET['sampai'];
if (isset($dari) && isset($sampai)) {
    $query = mysqli_query($koneksi, "SELECT SUM(total * harga) as jumlah, tgl as tanggal FROM `pesanan` WHERE tgl between '$dari' AND '$sampai'  GROUP BY tgl ORDER BY tgl desc");
} else {
    $query = mysqli_query($koneksi, "SELECT SUM(total * harga) as jumlah, tgl as tanggal FROM `pesanan` GROUP BY tgl ORDER BY tgl desc");
}
?>

<div>
    <form action="halaman/kas/penjualan/cetak.php" method="get">
        <div class="row">
            <div class="col-5">
                <input type="date" name="dari" value="<?= date('Y-m-d') ?>" class="form-control" required>
            </div>
            <div class="col-5">
                <input type="date" name="sampai" value="<?= date('Y-m-d') ?>" class="form-control" required>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Cetak</button>
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
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
                @$tngl = $row['tanggal'];
                $transaksi_harian = mysqli_query($koneksi, "SELECT * FROM `transaksi_harian` WHERE tanggal = '$tngl'");
                @$rowTransaksi = mysqli_fetch_assoc($transaksi_harian);
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
