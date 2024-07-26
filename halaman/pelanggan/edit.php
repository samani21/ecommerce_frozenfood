<?php
include "././koneksi.php";
if ($_SESSION['level'] == "Pelanggan") {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_user = '$id'");
    $row = mysqli_fetch_assoc($query);
} else {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
    $row = mysqli_fetch_assoc($query);
}
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Nama</label>
            <input type="hidden" name="id_pelanggan" value="<?= $row['id_pelanggan'] ?>" class="form-control" required>
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
            <label for="">Provensi</label>
            <input type="text" name="provinsi" value="<?= $row['provinsi'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Kecamatan</label>
            <input type="text" name="kecamatan" value="<?= $row['kecamatan'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Kelurahan</label>
            <input type="text" name="kelurahan" value="<?= $row['kelurahan'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">Alamat</label>
            <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" required>
        </div>
        <div>
            <label for="">No Hp</label>
            <input type="text" name="no_hp" value="<?= $row['no_hp'] ?>" class="form-control" required>
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
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $tempat = $_POST['tempat'];
    $tgl = $_POST['tgl'];
    $provinsi = $_POST['provinsi'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_pelanggan = $_POST['id_pelanggan'];

    mysqli_query($koneksi, "UPDATE pelanggan SET nama = '$nama',tempat = '$tempat',tgl = '$tgl',alamat = '$alamat',no_hp = '$no_hp',provinsi = '$provinsi',kecamatan = '$kecamatan',kelurahan = '$kelurahan' WHERE id_pelanggan = '$id_pelanggan'");
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {
            <?php
            if ($_SESSION['level'] == "Admin") {
            ?>
                window.location.href = "http://localhost/bikafrozen/index.php?page=pelanggan";

            <?php
            } else {
            ?>
                window.Headers();
            <?php
            }
            ?>

        }, 1000));
    </script>
<?php
}
?>