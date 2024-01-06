<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM ongkir WHERE id_ongkir = '$id'");
    $row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Kota</label>
            <input type="text" name="kota" value="<?= $row['kota'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Harga</label>
            <input type="text" name="harga" id="rupiah" value="<?= $hasil_rupiah = "Rp " . number_format($row['harga'],0,',','.') ?>"  class="form-control" required autofocus>
        </div>
        <div>
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
        $kota = $_POST['kota'];
        $harga = preg_replace('/[Rp. ]/','',$_POST['harga']);
        mysqli_query($koneksi,"UPDATE ongkir SET kota = '$kota',harga='$harga' WHERE id_ongkir = '$id'");
        ?>
<script>
            swal({
  title: "Success!",
  text: "Edit data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=ongkir";

}, 1000));
        </script>
        <?php
    }
?>