<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM link WHERE id_link = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Nama Live/Video</label>
            <input type="text" name="nama" value="<?= $row['nama'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Link</label>
            <input type="text" name="link" value="<?= $row['link'] ?>" class="form-control" required>
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

    mysqli_query($koneksi, "UPDATE link SET nama = '$nama',link = '$link' WHERE id_link = '$id'");
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=link_live";

        }, 1000));
    </script>
<?php
}
?>