<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
$row = mysqli_fetch_assoc($query);
?>
<div>
    <form action="" method="post">
        <div>
            <label for="">Nama</label>
            <input type="text" value="<?= $row['name'] ?>" class="form-control" name="name" autofocus required>
        </div>
        <div>
            <label for="">Username</label>
            <input type="text" value="<?= $row['username'] ?>" class="form-control" name="username" autofocus required>
        </div>
        <div>
            <label for="">Email</label>
            <input type="email" value="<?= $row['email'] ?>" class="form-control" name="email" autofocus required>
        </div>
        <div>
            <label for="">Level</label>
            <select class="form-control" name="level" autofocus required id="">
                <option value="<?= $row['level'] ?>"><?= $row['level'] ?></option>
                <option value="Pelanggan">Pelanggan</option>
                <option value="Admin">Admin</option>
                <option value="Super Admin">Super Admin</option>
            </select>
        </div>
        <div>
            <label for="">Password (jika tidak ganti password kosongi)</label>
            <input type="password" class="form-control" name="password">
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
    $email = $_POST['email'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);

    if ($_POST['password'] == "") {
        mysqli_query($koneksi, "UPDATE user SET name='$name',username='$username',email='$email',level='$level' WHERE id = '$id'");
    } else {
        mysqli_query($koneksi, "UPDATE user SET name='$name',username='$username',email='$email',level='$level',password='$password' WHERE id = '$id'");
    }
?>
    <script>
        swal({
            title: "Success!",
            text: "Edit data berhasil",
            type: "success"
        }, setTimeout(function() {

            window.location.href = "http://localhost/bikafrozen/index.php?page=user";

        }, 1000));
    </script>
<?php
}
?>