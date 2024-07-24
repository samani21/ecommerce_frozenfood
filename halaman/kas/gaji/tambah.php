<div>
    <form action="" method="post">
        <div>
            <label for="">Nama Karyawan</label>
            <input type="text" name="nama_karyawan" class="form-control" required autofocus>
        </div>
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
    $nama_karyawan = $_POST['nama_karyawan'];
    $jumlah = preg_replace('/[Rp. ]/', '', $_POST['jumlah']);
    mysqli_query($koneksi, "INSERT INTO gaji VALUES(null,'$nama_karyawan','$tanggal','$jumlah',0)");

    $query = mysqli_query($koneksi, 'SELECT * FROM gaji ORDER BY id_gaji DESC LIMIT 1');
    $res = mysqli_fetch_assoc($query);
    if ($res) {
        $id_gaji = $res['id_gaji'];
        $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
        $transaksi = mysqli_fetch_assoc($queryTransaksi);
        if (!$transaksi) {
            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Gaji $nama_karyawan','$jumlah','$jumlah','$jumlah',0,$jumlah,null,null,null,'$id_gaji',null)");
        } else {
            $awal = $transaksi['saldo_akhir'];
            $akhir = $awal - $jumlah;
            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','Gaji $nama_karyawan','$jumlah','$awal','$akhir',0,$jumlah,null,null,null,'$id_gaji',null)");
        }
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=gaji";

        }, 1000));
    </script>
<?php
}
?>