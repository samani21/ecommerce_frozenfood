<?php
include "././koneksi.php";
if ($_GET['page'] == "profil") {
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
        <div>
            <label for="">Password (kosongi jika tidak ganti password)</label>
            <input type="password" name="password" class="form-control">
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
    $provinsi = $_POST['provinsi'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $password = md5($_POST['password']);

    // Create a prepared statement
    $stmt = $koneksi->prepare("UPDATE pelanggan SET nama = ?, alamat = ?, no_hp = ?, provinsi = ?, kecamatan = ?, kelurahan = ? WHERE id_pelanggan = ?");
    // Bind parameters
    $stmt->bind_param("sssssss", $nama, $alamat, $no_hp, $provinsi, $kecamatan, $kelurahan, $id_pelanggan);
    // Execute the query
    $stmt->execute();
    // Close the statement
    $stmt->close();
    if (!$_POST['password'] == "") {
        mysqli_query($koneksi, "UPDATE user SET password='$password' WHERE id = '$id'");
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {
            <?php
            if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
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