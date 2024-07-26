<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM `jual_beli` RIGHT JOIN barang ON barang.id_barang = jual_beli.id_barang WHERE id_jual_beli is null");
?>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Nama Barang</label>
            <select name="id_barang" class="form-control" id="" required>
                <option value="">-Pilih</option>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <option value="<?= $row['id_barang'] ?>"> <?= $row['nm_barang'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label for="">Harga Beli</label>
            <input type="text" name="beli" class="form-control" id="rupiah" required>
        </div>
        <div>
            <label for="">Harga Jual</label>
            <input type="text" name="jual" class="form-control" id="rupiah1" required>
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
    mysqli_query($koneksi, "INSERT INTO jual_beli VALUES(null,'$id_barang','$beli','$jual')") or die(mysqli_error($koneksi));
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=jual_beli";

        }, 1000));
    </script>
<?php
}
?>