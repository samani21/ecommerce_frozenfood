<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT kondisi_barang.*,barang.*, kondisi_barang.total as jum FROM kondisi_barang JOIN barang ON barang.id_barang = kondisi_barang.id_barang WHERE id_kondisi = '$id'");
    $row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post" enctype="multipart/form-data">
    <div>
            <label for="">Nama Barang</label>
            <input type="text" name="nm_barang" class="form-control" value="<?= $row['nm_barang'] ?>" autocomplete="off" readonly>
        </div>
        <div>
            <label for="">Tanngal</label>
            <input type="date" name="tgl" value="<?= $row['tgl']?>" class="form-control" required >
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="number" name="jumlah" value="<?= $row['jum']?>" class="form-control" required autofocus>
        </div>
        <div>
                <label for="">Keterangan</label>
                <textarea name="keterangan" class="form-control" id="" cols="30" rows="10"><?= $row['keterangan']?></textarea>
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
        $jumlah = $_POST['jumlah'];
        $tgl = $_POST['tgl'];
        $keterangan = $_POST['keterangan'];

        mysqli_query($koneksi,"UPDATE kondisi_barang SET total='$jumlah',tgl='$tgl',keterangan='$keterangan' WHERE id_kondisi = '$id'");
        ?>
        <script>
            swal({
  title: "Success!",
  text: "Tambah data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=barang_rusak";

}, 1000));
        </script>
        <?php   
    }
?>