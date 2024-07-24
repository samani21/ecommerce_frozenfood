<div>
    <form action="" method="post">
        <div>
            <label for="">Kota</label>
            <input type="text" name="kurir" class="form-control" required autofocus>
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
    $kurir = $_POST['kurir'];
    mysqli_query($koneksi, "INSERT INTO kurir VALUES(null,'$kurir')");
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=kurir";

        }, 1000));
    </script>
<?php
}
?>