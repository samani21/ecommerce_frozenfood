<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" value="<?= date('Y-m-d') ?>" name="tanggal" class="form-control" required>
        </div>
        <div>
            <label for="">Deskripsi</label>
            <textarea class="form-control" required name="deskripsi" id=""></textarea>
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
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($koneksi, "INSERT INTO komplen VALUES(null,'$tanggal','$deskripsi')");
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=komplen";

        }, 1000));
    </script>
<?php
}
?>