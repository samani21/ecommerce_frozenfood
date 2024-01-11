<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM supplier WHERE id_supplier = '$id'");
    $row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Nama Supplier</label>
            <input type="text" name="nm_supplier" value="<?= $row['nm_supplier'] ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Alamat</label>
            <input type="text" name="alamat" value="<?= $row['alamat'] ?>"  class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Kota</label>
            <input type="text" name="kota" value="<?= $row['kota'] ?>"  class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Telp</label>
            <input type="text" name="telp" value="<?= $row['telp'] ?>"  class="form-control" required >
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
        $nm_supplier = $_POST['nm_supplier'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        $telp = $_POST['telp'];
        mysqli_query($koneksi,"UPDATE supplier SET kota = '$kota',nm_supplier='$nm_supplier',telp='$telp',alamat='$alamat' WHERE id_supplier = '$id'");
        ?>
<script>
            swal({
  title: "Success!",
  text: "Edit data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=supplier";

}, 1000));
        </script>
        <?php
    }
?>