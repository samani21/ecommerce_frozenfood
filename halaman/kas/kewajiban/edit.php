<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kewajiban WHERE id_kewajiban = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" required autofocus id=""><?= $row['deskripsi'] ?></textarea>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="text" name="jumlah" class="form-control" value="<?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?>" id="rupiah" required>
        </div>
        <div>
            <label for="">Status</label>
            <select name="status" class="form-control" id="" required>
                <option value="<?= $row['status'] ?>"><?= $row['status'] ?></option>
                <option value="Belum dibayar">Belum dibayar</option>
                <option value="Sudah dibayar">Sudah dibayar</option>
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
    mysqli_query($koneksi, "UPDATE kewajiban SET tanggal = '$tanggal',jumlah = '$jumlah',`status`='$status',deskripsi= '$deskripsi' WHERE id_kewajiban = '$id'");

    if ($status == "Sudah dibayar") {
        $query = mysqli_query($koneksi, "SELECT * FROM transaksi_harian WHERE id_kewajiban = '$id'");
        $res = mysqli_fetch_assoc($query);
        if ($res) {
            $akhir = $res['saldo_akhir'] + $res['jumlah'] - $jumlah;
            mysqli_query($koneksi, "UPDATE transaksi_harian SET tanggal = '$tanggal',jumlah = '$jumlah',saldo_akhir = '$akhir',pengeluaran=$jumlah WHERE id_kewajiban = '$id'");
        } else {
            $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
            $transaksi = mysqli_fetch_assoc($queryTransaksi);
            $awal =  $transaksi['saldo_akhir'];
            $akhir =  $transaksi['saldo_akhir'] - $jumlah;

            mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$awal','$akhir',0,$jumlah,null,'$id',null,null,null)");
        }
    } else {
        mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_kewajiban = '$id'");
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=kewajiban";

        }, 1000));
    </script>
<?php
}
?>