<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_penjualan = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Harga</label>
            <input type="text" name="jumlah" class="form-control" value="<?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?>" id="rupiah" required>
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
    mysqli_query($koneksi, "UPDATE penjualan SET tanggal = '$tanggal',jumlah = '$jumlah' WHERE id_penjualan = '$id'");

    $query = mysqli_query($koneksi, "SELECT * FROM transaksi_harian WHERE id_penjualan = '$id'");
    $res = mysqli_fetch_assoc($query);
    if ($res) {
        $akhir = $res['saldo_akhir'] - $res['jumlah'] + $jumlah;
        mysqli_query($koneksi, "UPDATE transaksi_harian SET tanggal = '$tanggal',jumlah = '$jumlah',saldo_akhir = '$akhir',pemasukkan='$jumlah' WHERE id_penjualan = '$id'");
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=penjualan";

        }, 1000));
    </script>
<?php
}
?>