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
                <th>Aksi</th>
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
                    <td>
                        <?php
                        if (isset($rowTransaksi['tanggal'])) {
                        } else {
                        ?>
                            <form action="" method="post">
                                <input type="hidden" name="tanggal" value="<?= $row['tanggal'] ?>">
                                <input type="hidden" name="jumlah" value="<?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?>">
                                <button class="btn btn-success" name="simpan">ACC</button>
                            </form>
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

<?php
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $jumlah = preg_replace('/[Rp. ]/', '', $_POST['jumlah']);
    $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
    $transaksi = mysqli_fetch_assoc($queryTransaksi);
    if (!$transaksi) {
        mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Penjualan','$jumlah','$jumlah','$jumlah','$jumlah',0,0,null,null,null,null)");
    } else {
        $awal = $transaksi['saldo_akhir'];
        $akhir = $awal + $jumlah;
        mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Penjualan','$jumlah','$awal','$akhir','$jumlah',0,0,null,null,null,null)");
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=penjualan";

        }, 1000));
    </script>
<?php
}
?>