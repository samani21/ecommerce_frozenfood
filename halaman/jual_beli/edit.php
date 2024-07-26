<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM jual_beli JOIN barang ON barang.id_barang = jual_beli.id_barang WHERE id_jual_beli = '$id'");
$row = mysqli_fetch_assoc($query);

?>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Nama Barang</label>
            <select name="id_barang" class="form-control" id="" required read>
                <option value="<?= $row['id_barang'] ?>"><?= $row['nm_barang'] ?></option>
            </select>
        </div>
        <div>
            <label for="">Harga Beli</label>
            <input type="text" name="beli" id="rupiah" value="<?= $hasil_rupiah = "Rp " . number_format($row['beli'], 0, ',', '.') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Harga Jual</label>
            <input type="text" name="jual" id="rupiah1" value="<?= $hasil_rupiah = "Rp " . number_format($row['jual'], 0, ',', '.') ?>" class="form-control" required autofocus>
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
    $beli = preg_replace('/[Rp. ]/', '', $_POST['beli']);
    $jual = preg_replace('/[Rp. ]/', '', $_POST['jual']);
    $id_barang = $_POST['id_barang'];

    mysqli_query($koneksi, "UPDATE jual_beli SET id_barang='$id_barang',beli='$beli',jual='$jual' WHERE id_jual_beli ='$id'") or die(mysqli_error($koneksi));
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=jual_beli";

        }, 1000));
    </script>
<?php
}
?>