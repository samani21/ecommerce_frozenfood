<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query1 = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE id_barang = '$id'");
    $row_bm = mysqli_fetch_assoc($query1);
?>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Nama Barang</label>
            <input type="hidden" name="id_barang" value="<?= $row_bm['id_barang'] ?>" class="form-control" autocomplete="off" required readonly>
            <input type="text" value="<?= $row_bm['nm_barang'] ?>" class="form-control" autocomplete="off" required readonly>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tgl" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required autofocus>
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
        $id_barang = $_POST['id_barang'];
        $jumlah = $_POST['jumlah'];
        $tgl = $_POST['tgl'];
        $harga = preg_replace('/[Rp. ]/','',$_POST['harga']);

        mysqli_query($koneksi,"INSERT INTO barang_masuk VALUES(null,'$id_barang','$jumlah','$tgl','$harga')");
        ?>
        <script>
            swal({
  title: "Success!",
  text: "Tambah data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=barang_masuk";

}, 1000));
        </script>
        <?php   
    }
?>