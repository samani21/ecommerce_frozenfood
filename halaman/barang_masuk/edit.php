<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT barang_masuk.*,barang.*, barang_masuk.jumlah as jum FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang WHERE id_barang_masuk = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Nama Barang</label>
            <input type="text" name="nm_barang" class="form-control" value="<?= $row['nm_barang'] ?>" autocomplete="off" readonly>
        </div>
        <div>
            <label for="">Tanngal</label>
            <input type="date" name="tgl" value="<?= $row['tgl'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="number" name="jumlah" value="<?= $row['jum'] ?>" class="form-control" required autofocus>
        </div>
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
    $jumlah = $_POST['jumlah'];
    $tgl = $_POST['tgl'];

    mysqli_query($koneksi, "UPDATE barang_masuk SET jumlah='$jumlah',tgl='$tgl' WHERE id_barang_masuk = '$id'");
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=barang_masuk";

        }, 1000));
    </script>
<?php
}
?>