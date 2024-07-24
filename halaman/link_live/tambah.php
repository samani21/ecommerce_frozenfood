<div>
    <form action="" method="post">
        <div>
            <label for="">Nama live/video</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div>
            <label for="">Nama link</label>
            <input type="text" name="link" class="form-control" required>
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
    $nama = $_POST['nama'];
    $link = $_POST['link'];

    mysqli_query($koneksi, "INSERT INTO link VALUES(null,'$nama','$link')");
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=link_live";

        }, 1000));
    </script>
<?php
}
?>