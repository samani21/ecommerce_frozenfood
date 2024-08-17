<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Supplier</label>
            <select name="id_supplier" class="form-control" id="">
                <option value="">-Pilih supplier</option>
                <?php
                include '././koneksi.php';
                $querySupplier = mysqli_query($koneksi, "SELECT * FROM supplier");
                while ($rs = mysqli_fetch_array($querySupplier)) {
                ?>
                    <option value="<?= $rs['id_supplier'] ?>"><?= $rs['nm_supplier'] ?></option>
                <?Php
                }
                ?>
            </select>
        </div>
        <div>
            <label for="">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id=""></textarea>
        </div>
        <div>
            <label for="">Status</label>
            <select name="status" class="form-control" id="" required>
                <option value="">-pilih</option>
                <option value="Lunas">Lunas</option>
                <option value="Cicil">Cicil</option>
            </select>
        </div>
        <div>
            <label for="">Jumlah Transaksi</label>
            <input type="text" name="jumlah_hutang" class="form-control" id="rupiah" required>
        </div>
        <div>
            <br>
            <div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <button type="reset" name="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</div>


<?php
include "././koneksi.php";
if (isset($_POST['simpan'])) {
    $status = $_POST['status'];

    if ($status == "Lunas") {
        $jumlah_hutang = preg_replace('/[Rp. ]/', '', $_POST['jumlah_hutang']);


        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];
        $id_supplier = $_POST['id_supplier'];
        mysqli_query($koneksi, "INSERT INTO hutang VALUES(null,'$id_supplier','$tanggal','$deskripsi',$jumlah_hutang)");

        $queryHutang = mysqli_query($koneksi, "SELECT * FROM hutang JOIN supplier ON supplier.id_supplier = hutang.id_supplier ORDER BY id_hutang desc limit 1");
        $rowHutang = mysqli_fetch_assoc($queryHutang);

        $deskripsi = $_POST['deskripsi'];
        $id_hutang = $rowHutang['id_hutang'];
        $nm_supplier = $rowHutang['nm_supplier'];
        $status = $_POST['status'];
        $deskripsi = $_POST['deskripsi'];

        $query = mysqli_query($koneksi, "SELECT * FROM piutang ORDER BY id_piutang DESC limit 1");
        $invoice = mysqli_fetch_assoc($query);
        @$no_invoice1 = $invoice['no_invoice'];
        $tahun = substr(date('Y'), -2);
        if ($no_invoice1) {
            // Mengambil 4 digit terakhir dari nomor invoice
            $last_four_digits = substr($no_invoice1, -4);
            if ($last_four_digits < 10) {
                $inputInvoice = "000" . $last_four_digits + 1;
            } else if ($last_four_digits < 100) {
                $inputInvoice = "00" . $last_four_digits + 1;
            } else if ($last_four_digits < 1000) {
                $inputInvoice = "0" . $last_four_digits + 1;
            } else if ($last_four_digits < 10000) {
                $inputInvoice = "" . $last_four_digits + 1;
            }
        } else {
            $inputInvoice = "000" . 1;
        }
        mysqli_query($koneksi, "INSERT INTO piutang VALUES(null, '$id_hutang', 'BTK$tahun$inputInvoice', '$tanggal', '$deskripsi', '$jumlah_hutang', 'Sudah dibayar', 0)");

        $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
        $transaksi = mysqli_fetch_assoc($queryTransaksi);
        $query = mysqli_query($koneksi, 'SELECT * FROM piutang ORDER BY id_piutang DESC LIMIT 1');
        $res = mysqli_fetch_assoc($query);
        $id_piutang = $res['id_piutang'];
        if (!$transaksi) {
            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Pemmbayaran  $nm_supplier','$jumlah_bayar','$jumlah_bayar',0,0,$jumlah_bayar,$id_piutang)");
        } else {
            $awal = $transaksi['saldo_akhir'];
            $akhir = $awal - $jumlah_hutang;
            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Pembayaran transaksi ke $nm_supplier','$jumlah_hutang','$awal','$akhir',0,$jumlah_hutang,$id_piutang)");
        }
?>
        <script>
            swal({
                title: "Success!",
                text: "Tambah data berhasil",
                type: "success"
            }, setTimeout(function() {
                window.location.href = "http://localhost/bikafrozen/index.php?page=sisa_hutang";
            }, 1000));
        </script>
    <?php
    } else {
        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];
        $id_supplier = $_POST['id_supplier'];
        $jumlah_hutang = preg_replace('/[Rp. ]/', '', $_POST['jumlah_hutang']);
        mysqli_query($koneksi, "INSERT INTO hutang VALUES(null,'$id_supplier','$tanggal','$deskripsi',$jumlah_hutang)");

    ?>
        <script>
            swal({
                title: "Success!",
                text: "Tambah data berhasil",
                type: "success"
            }, setTimeout(function() {
                window.location.href = "http://localhost/bikafrozen/index.php?page=sisa_hutang";
            }, 1000));
        </script>
<?php
    }
}
?>