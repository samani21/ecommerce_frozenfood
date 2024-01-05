<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM kategori WHERE id_kategori = '$id'");
    $row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Nama Kategori</label>
            <input type="text" name="nm_kategori" value="<?= $row['nm_kategori'] ?>" class="form-control" required>
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
    if(isset($_POST['simpan'])){
        $nm_kategori = $_POST['nm_kategori'];

        mysqli_query($koneksi,"UPDATE kategori SET nm_kategori = '$nm_kategori' WHERE id_kategori = '$id'");
        ?>
<script>
            swal({
  title: "Success!",
  text: "Edit data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=kategori";

}, 1000));
        </script>
        <?php
    }
?>