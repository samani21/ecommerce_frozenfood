<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Jenis Transaksi</label>
            <div class="row">
                <div class="col-2">
                    <input type="radio" id="baru" name="jenis" value="hutang baru" onclick="toggleForm()">
                    <label for="baru">Hutang Baru</label>
                </div>
                <div class="col-2">
                    <input type="radio" id="bayar" name="jenis" value="bayar hutang" onclick="toggleForm()">
                    <label for="bayar">Bayar Hutang</label>
                </div>
            </div>
        </div>
        <div id="form-baru" style="display:none;">
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
                <label for="">Jumlah</label>
                <input type="text" name="jumlah_hutang" class="form-control" id="rupiah">
            </div>
        </div>
        <div id="form-bayar" style="display:none;">
            <div>
                <label for="">Hutang Dari</label>

            </div>
            <div>
                <label for="">Jumlah Bayar</label>
                <input type="text" name="jumlah_bayar" class="form-control">
            </div>
            <div>
                <label for="">Status</label>
                <select name="status" class="form-control" id="">
                    <option value="">--Pilih status</option>
                    <option value="Belum dibayar">Belum dibayar</option>
                    <option value="Sudah dibayar">Sudah dibayar</option>
                </select>
            </div>
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

<script>
    function toggleForm() {
        var baru = document.getElementById('baru').checked;
        var bayar = document.getElementById('bayar').checked;

        if (baru) {
            document.getElementById('form-baru').style.display = 'block';
            document.getElementById('form-bayar').style.display = 'none';
        } else if (bayar) {
            document.getElementById('form-baru').style.display = 'none';
            document.getElementById('form-bayar').style.display = 'block';
        }
    }
</script>

<?php
include "././koneksi.php";
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    if ($jenis == "hutang baru") {
        $deskripsi = $_POST['deskripsi'];
        $id_supplier = $_POST['id_supplier'];
        $jumlah_hutang = preg_replace('/[Rp. ]/', '', $_POST['jumlah_hutang']);
        mysqli_query($koneksi, "INSERT INTO piutang VALUES(null,'$id_supplier','$tanggal','$jenis','$deskripsi',$jumlah_hutang,null,null,null)");
    } else {
        if ($_POST['jenis_transaksi'] == 'baru') {
            $deskripsi = $_POST['deskripsi'];
            $status = $_POST['status'];
            $jumlah = preg_replace('/[Rp. ]/', '', $_POST['jumlah']);
            mysqli_query($koneksi, "INSERT INTO piutang VALUES(null,'$tanggal','$deskripsi','$jumlah','$status',0)");

            if ($status == "Sudah dibayar") {
                $query = mysqli_query($koneksi, 'SELECT * FROM piutang ORDER BY id_piutang DESC LIMIT 1');
                $res = mysqli_fetch_assoc($query);
                if ($res) {
                    $id_piutang = $res['id_piutang'];
                    $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
                    $transaksi = mysqli_fetch_assoc($queryTransaksi);
                    if (!$transaksi) {
                        mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$jumlah','$jumlah',$jumlah,0,null,null,'$id_piutang',null,null)");
                    } else {
                        $awal = $transaksi['saldo_akhir'];
                        $akhir = $awal + $jumlah;
                        mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$awal','$akhir',$jumlah,0,null,null,'$id_piutang',null,null)");
                    }
                }
            }
        } else if ($_POST['jenis_transaksi'] == 'bayar') {
            $id_piutang = $_POST['id_piutang'];
            $jumlah_bayar = preg_replace('/[Rp. ]/', '', $_POST['jumlah_bayar']);
            $query = mysqli_query($koneksi, "SELECT * FROM piutang WHERE id_piutang = '$id_piutang'");
            $piutang = mysqli_fetch_assoc($query);
            if ($piutang) {
                $sisa_piutang = $piutang['jumlah'] - $jumlah_bayar;
                mysqli_query($koneksi, "UPDATE piutang SET jumlah = '$sisa_piutang' WHERE id_piutang = '$id_piutang'");

                $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
                $transaksi = mysqli_fetch_assoc($queryTransaksi);
                if (!$transaksi) {
                    mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Pembayaran Piutang #$id_piutang','$jumlah_bayar','$jumlah_bayar','$jumlah_bayar',$jumlah_bayar,0,null,null,null,null,null)");
                } else {
                    $awal = $transaksi['saldo_akhir'];
                    $akhir = $awal - $jumlah_bayar;
                    mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Pembayaran Piutang #$id_piutang','$jumlah_bayar','$awal','$akhir',$jumlah_bayar,0,null,null,null,null,null)");
                }
            }
        }
?>
        <script>
            swal({
                title: "Success!",
                text: "Tambah data berhasil",
                type: "success"
            }, setTimeout(function() {
                window.location.href = "http://localhost/bikafrozen/index.php?page=piutang";
            }, 1000));
        </script>
<?php
    }
}
?>