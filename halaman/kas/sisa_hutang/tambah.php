<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Supplier</label>
            <select name="id_supplier" class="form-control" id="">
                <option value="">-Pilih supplier</option>
                <?php
                include '././koneksi.php';
                $querySupplier = mysqli_query($koneksi, "SELECT supplier.* FROM hutang RIGHT JOIN supplier ON supplier.id_supplier = hutang.id_supplier WHERE hutang.id_supplier IS NULL");
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
        <div>
            <br>
            <div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <button type="reset" name="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</div>


<?php
include "././koneksi.php";
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $id_supplier = $_POST['id_supplier'];
    $jumlah_hutang = preg_replace('/[Rp. ]/', '', $_POST['jumlah_hutang']);
    mysqli_query($koneksi, "INSERT INTO hutang VALUES(null,'$id_supplier','$tanggal','$deskripsi',$jumlah_hutang)");
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {
            window.location.href = "http://localhost/bikafrozen/index.php?page=sisa_hutang";
        }, 1000));
    </script>
<?php
}
?>