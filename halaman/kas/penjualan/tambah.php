<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Harga</label>
            <input type="text" name="jumlah" class="form-control" id="rupiah" required>
        </div>
        <div>
            <br>
            <div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <button type="reset" name="simpan" class="btn btn-danger">Reset</button>
            </div>
    </form>
</div>

<?php
include "././koneksi.php";
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $jumlah = preg_replace('/[Rp. ]/', '', $_POST['jumlah']);
    mysqli_query($koneksi, "INSERT INTO penjualan VALUES(null,'$tanggal','$jumlah',0)");

    $query = mysqli_query($koneksi, 'SELECT * FROM penjualan ORDER BY id_penjualan DESC LIMIT 1');
    $res = mysqli_fetch_assoc($query);
    if ($res) {
        $id_penjualan = $res['id_penjualan'];
        $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
        $transaksi = mysqli_fetch_assoc($queryTransaksi);
        if (!$transaksi) {
            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Penjualan','$jumlah','$jumlah','$jumlah','$jumlah',0,'$id_penjualan',null,null,null,null)");
        } else {
            $awal = $transaksi['saldo_akhir'];
            $akhir = $awal + $jumlah;
            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Penjualan','$jumlah','$awal','$akhir','$jumlah',0,'$id_penjualan',null,null,null,null)");
        }
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