<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <?php
            include "././koneksi.php";
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
            }?>
            <input type="text" name="no_invoice" value="<?= "BTK" . $tahun . $inputInvoice ?>" class="form-control" required readonly autofocus>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Hutang Dari</label>
            <select name="id_hutang" class="form-control" id="supplierDropdown" onchange="updateSisaHutang()">
                <option value="">-Pilih supplier</option>
                <?php
                include '././koneksi.php';
                $querySupplier = mysqli_query($koneksi, "SELECT supplier.nm_supplier,hutang.deskripsi,hutang.tanggal,hutang.id_hutang,hutang.id_hutang, jumlah_hutang,SUM(piutang.jumlah), jumlah_hutang- SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN jumlah ELSE 0 END) as sisa_hutang FROM `hutang` left JOIN piutang ON piutang.id_hutang = hutang.id_hutang JOIN supplier ON supplier.id_supplier = hutang.id_supplier GROUP BY hutang.id_hutang");
                while ($rs = mysqli_fetch_array($querySupplier)) {
                    if ($rs['sisa_hutang'] != 0) {
                ?>
                        <option value="<?= $rs['id_hutang'] ?>" data-sisa-hutang="<?= $rs['sisa_hutang'] ?>" supplier="<?= $rs['nm_supplier'] ?>" deskripsi="<?= $rs['deskripsi'] ?>"><?= $rs['nm_supplier'] ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <div>
            <label for="">Sisa Hutang</label>
            <input type="text" id="sisaHutang" name="sisa_hutang" class="form-control" readonly>
            <input type="hidden" id="nama_supplier" name="supplier" class="form-control" readonly>
            <input type="hidden" id="deskripsi1" name="deskripsi" class="form-control" readonly>
        </div>
        <div>
            <label for="">Jumlah Bayar</label>
            <input type="text" name="jumlah" class="form-control" id="rupiah">
        </div>
        <div>
            <label for="">Status</label>
            <select name="status" class="form-control" id="">
                <option value="">--Pilih status</option>
                <option value="Belum dibayar">Belum dibayar</option>
                <option value="Sudah dibayar">Sudah dibayar</option>
            </select>
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

    function updateSisaHutang() {
        var dropdown = document.getElementById("supplierDropdown");
        var sisaHutangInput = document.getElementById("sisaHutang");
        var supplierInput = document.getElementById("nama_supplier");
        var deskripsiInput = document.getElementById("deskripsi1");
        var selectedOption = dropdown.options[dropdown.selectedIndex];
        var sisaHutang = selectedOption.getAttribute("data-sisa-hutang");
        var supplier = selectedOption.getAttribute("supplier");
        var deskripsi = selectedOption.getAttribute("deskripsi");

        sisaHutangInput.value = sisaHutang ? 'Rp. ' + formatRupiah(sisaHutang) : '';
        supplierInput.value = supplier ? supplier : '';
        deskripsiInput.value = deskripsi ? deskripsi : '';
    }

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }
</script>
</script>

<?php
include "././koneksi.php";
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $sisa_hutang = preg_replace('/[Rp. ]/', '', $_POST['sisa_hutang']);
    $jumlah = preg_replace('/[Rp. ]/', '', $_POST['jumlah']);
    if ($sisa_hutang < $jumlah) {
?>
        <script>
            swal({
                title: "Gagal!",
                text: "Jumlah dibayar melebihi hutang",
                type: "error"
            }, setTimeout(function() {
                window.location.href = "http://localhost/bikafrozen/index.php?page=piutang";
            }, 1000));
        </script>
    <?php
    } else {
        $deskripsi = $_POST['deskripsi'];
        $id_hutang = $_POST['id_hutang'];
        $status = $_POST['status'];
        $supplier = $_POST['supplier'];
        $deskripsi = $_POST['deskripsi'];
        $no_invoice = $_POST['no_invoice'];
        mysqli_query($koneksi, "INSERT INTO piutang VALUES(null,'$id_hutang','$no_invoice','$tanggal','$deskripsi','$jumlah','$status',0)");
        if ($status == "Sudah dibayar") {
            $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
            $transaksi = mysqli_fetch_assoc($queryTransaksi);
            $query = mysqli_query($koneksi, 'SELECT * FROM piutang ORDER BY id_piutang DESC LIMIT 1');
            $res = mysqli_fetch_assoc($query);
            $id_piutang = $res['id_piutang'];
            $id_piutang = $res['id_piutang'];
            if (!$transaksi) {
                mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Pembayaran Piutang $supplier','$jumlah','$jumlah','$jumlah',0,$jumlah,null,null,null,null,null)");
            } else {
                $awal = $transaksi['saldo_akhir'];
                $akhir = $awal - $jumlah;
                mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Pembayaran hutang ke $supplier','$jumlah','$awal','$akhir',0,$jumlah,null,null,$id_piutang,null,null)");
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