<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
    $row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Nama</label>
            <input type="text" name="nama" value="<?= $row['nama'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Tempat</label>
            <input type="text" name="tempat" value="<?= $row['tempat'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Tanggal</label>
            <input type="text" name="tgl" value="<?= $row['tgl'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Alamat</label>
            <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" required>
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
        $nama = $_POST['nama'];
        $tempat = $_POST['tempat'];
        $tgl = $_POST['tgl'];
        $alamat = $_POST['alamat'];

        mysqli_query($koneksi,"UPDATE pelanggan SET nama = '$nama',tempat = '$tempat',tgl = '$tgl',alamat = '$alamat' WHERE id_pelanggan = '$id'");
        ?>
<script>
            swal({
  title: "Success!",
  text: "Edit data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=pelanggan";

}, 1000));
        </script>
        <?php
    }
?>