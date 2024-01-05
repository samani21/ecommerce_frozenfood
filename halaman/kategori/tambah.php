<div>
    <form action="" method="post">
        <div>
            <label for="">Nama Kategori</label>
            <input type="text" name="nm_kategori" class="form-control" required>
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

        mysqli_query($koneksi,"INSERT INTO kategori VALUES(null,'$nm_kategori')");
        ?>
        <script>
            swal({
  title: "Success!",
  text: "Tambah data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=kategori";

}, 1000));
        </script>
        <?php   
    }
?>