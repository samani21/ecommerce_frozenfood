<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM komplen WHERE id_komplen = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">komplen</label>
            <textarea name="deskripsi" class="form-control" id=""><?= $row['deskripsi'] ?></textarea>
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

    mysqli_query($koneksi, "UPDATE komplen SET tanggal = '$tanggal',deskripsi = '$deskripsi' WHERE id_komplen = '$id'");
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=komplen";

        }, 1000));
    </script>
<?php
}
?>