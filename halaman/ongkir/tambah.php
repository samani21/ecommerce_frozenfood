<div>
    <form action="" method="post">
        <div>
            <label for="">Kota</label>
            <input type="text" name="kota" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Harga</label>
            <input type="text" name="harga" class="form-control" id="rupiah" required >
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
        $kota = $_POST['kota'];
        $harga = preg_replace('/[Rp. ]/','',$_POST['harga']);

        mysqli_query($koneksi,"INSERT INTO ongkir VALUES(null,'$kota','$harga')");
        ?>
        <script>
            swal({
  title: "Success!",
  text: "Tambah data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=ongkir";

}, 1000));
        </script>
        <?php   
    }
?>