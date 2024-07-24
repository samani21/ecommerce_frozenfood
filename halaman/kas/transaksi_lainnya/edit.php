<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM transaksi_lainnya WHERE id_transaksi_lainnya = '$id'");
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
                <option value="Masuk">Masuk</option>
                <option value="Keluar">Keluar</option>
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
    mysqli_query($koneksi, "UPDATE transaksi_lainnya SET tanggal = '$tanggal',jumlah = '$jumlah',`status`='$status',deskripsi= '$deskripsi' WHERE id_transaksi_lainnya = '$id'");

    if ($status == "Masuk") {
        mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_transaksi_lainnya = '$id'");

        $query = mysqli_query($koneksi, 'SELECT * FROM transaksi_lainnya ORDER BY id_transaksi_lainnya DESC LIMIT 1');
        $res = mysqli_fetch_assoc($query);
        if ($res) {
            $id_transaksi_lainnya = $res['id_transaksi_lainnya'];
            $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
            $transaksi = mysqli_fetch_assoc($queryTransaksi);
            if (!$transaksi) {
                mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$jumlah','$jumlah',$jumlah,0,null,null,null,null,'$id_transaksi_lainnya')");
            } else {
                $awal = $transaksi['saldo_akhir'];
                $akhir = $awal + $jumlah;
                mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$awal','$akhir',$jumlah,0,null,null,null,null,'$id_transaksi_lainnya')");
            }
        }
    } else {
        mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_transaksi_lainnya = '$id'");

        $query = mysqli_query($koneksi, 'SELECT * FROM transaksi_lainnya ORDER BY id_transaksi_lainnya DESC LIMIT 1');
        $res = mysqli_fetch_assoc($query);
        if ($res) {
            $id_transaksi_lainnya = $res['id_transaksi_lainnya'];
            $queryTransaksi = mysqli_query($koneksi, 'SELECT * FROM transaksi_harian ORDER BY id_transaksi DESC LIMIT 1');
            $transaksi = mysqli_fetch_assoc($queryTransaksi);
            if (!$transaksi) {
                mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$jumlah','$jumlah',0,$jumlah,null,null,null,null,'$id_transaksi_lainnya')");
            } else {
                $awal = $transaksi['saldo_akhir'];
                $akhir = $awal - $jumlah;
                mysqli_query($koneksi, "INSERT INTO transaksi_harian VALUES(null,'$tanggal','$deskripsi','$jumlah','$awal','$akhir',0,$jumlah,null,null,null,null,'$id_transaksi_lainnya')");
            }
        }
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=transaksi_lainnya";

        }, 1000));
    </script>
<?php
}
?>