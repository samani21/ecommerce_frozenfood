<div>
    <form action="" method="post">
        <div>
            <label for="">Nama</label>
            <input type="text" class="form-control" name="name" autofocus required>
        </div>
        <div>
            <label for="">Username</label>
            <input type="text" class="form-control" name="username" autofocus required>
        </div>
        <div>
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" autofocus required>
        </div>
        <div>
            <label for="">Level</label>
            <select class="form-control" name="level" autofocus required id="">
                <option value="">--Pilih</option>
                <option value="Pelanggan">Pelanggan</option>
                <option value="Admin">Admin</option>
                <option value="Super Admin">Super Admin</option>
            </select>
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" autofocus required>
        </div>
        <br>
        <div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <button type="reset" name="simpan" class="btn btn-danger">Reset</button>
        </div>
    </form>
</div>

<?php
include "koneksi.php";
require "send_mail.php";
if (isset($_POST['simpan'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);
    $verification_code = bin2hex(random_bytes(16)); // Generate verification code


    $stmt = $koneksi->prepare("INSERT INTO user VALUES (null, '$username', '$email', '$name', '$password', '$level', '$verification_code', 0)");
    if ($stmt->execute()) {
        // Kirim email verifikasi
        if (sendVerificationEmail($email, $verification_code)) {
            echo "Verification email sent. Please check your inbox.";
        } else {
            echo "Failed to send verification email.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

?>
    <script>
        window.location = "http://localhost/bikafrozen/index.php?page=user";
    </script>
<?php
}
?>