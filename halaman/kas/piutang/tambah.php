<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" required autofocus id=""></textarea>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="text" name="jumlah" class="form-control" id="rupiah" required>
        </div>
        <div>
            <label for="">Status</label>
            <select name="status" class="form-control" id="" required>
                <option value="">--Pilih status</option>
                <option value="Belum diterima">Belum diterima</option>
                <option value="Sudah diterima">Sudah diterima</option>
            </select>
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
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status'];
    $jumlah = preg_replace('/[Rp. ]/', '', $_POST['jumlah']);
    mysqli_query($koneksi, "INSERT INTO piutang VALUES(null,'$tanggal','$deskripsi','$jumlah','$status',0)");

    if ($status == "Sudah diterima") {
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
?>