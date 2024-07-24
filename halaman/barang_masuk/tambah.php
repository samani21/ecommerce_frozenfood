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
            <label for="">Supplier</label>
            <select name="id_supplier" class="form-control" id="" required>
            <option value="">--pilih</option>
            <?php
                    $qr = mysqli_query($koneksi,"SELECT * FROM supplier");
                    while($rw = mysqli_fetch_array($qr)){
            ?>
            <option value="<?= $rw['id_supplier'] ?>"><?= $rw['nm_supplier'] ?></option>
            <?php
            }
            ?>
            </select>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tgl" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required autofocus>
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
        $id_supplier = $_POST['id_supplier'];
        $jumlah = $_POST['jumlah'];
        $tgl = $_POST['tgl'];

        mysqli_query($koneksi,"INSERT INTO barang_masuk VALUES(null,'$id_supplier','$id_barang','$jumlah','$tgl')") or die(mysqli_error($koneksi));
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