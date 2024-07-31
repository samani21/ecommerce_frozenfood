<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM hutang join supplier ON supplier.id_supplier = hutang.id_supplier WHERE id_hutang = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Tanggal</label>
            <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" required autofocus>
        </div>
        <div>
            <label for="">Supplier</label>
            <select name="id_supplier" class="form-control" id="">
                <option value="<?= $row['id_supplier'] ?>"><?= $row['nm_supplier'] ?></option>
            </select>
        </div>
        <div>
            <label for="">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id=""><?= $row['deskripsi'] ?></textarea>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="text" name="jumlah_hutang" class="form-control" value="<?= $hasil_rupiah = "Rp " . number_format($row['jumlah_hutang'], 0, ',', '.') ?>" id="rupiah" required>
        </div>
        <br>
        <div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
</div>
</form>
</div>


<?php
include "././koneksi.php";
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];
    $id_supplier = $_POST['id_supplier'];
    $jumlah_hutang = preg_replace('/[Rp. ]/', '', $_POST['jumlah_hutang']);
    mysqli_query($koneksi, "UPDATE hutang SET tanggal = '$tanggal',jumlah_hutang = '$jumlah_hutang',deskripsi= '$deskripsi' WHERE id_hutang = '$id'");
?>
    <script>
        swal({
            title: "Success!",
            text: "Tambah data berhasil",
            type: "success"
        }, setTimeout(function() {
            window.location.href = "http://localhost/bikafrozen/index.php?page=sisa_hutang";
        }, 1000));
    </script>
<?php
}
?>