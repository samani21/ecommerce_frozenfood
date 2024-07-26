<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
</head>

<body>
    <div class="container">
        <div class="card">
            <h5 class="card-header bg-info">Daftar Akun</h5>
            <div class="card-body">
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
        </div>
    </div>
    <?php
    include "koneksi.php";
    require "send_mail.php";
    if (isset($_POST['simpan'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = md5($_POST['password']);
        $verification_code = bin2hex(random_bytes(16)); // Generate verification code


        $stmt = $koneksi->prepare("INSERT INTO user VALUES (null, '$username', '$email', '$name', '$password', 'Pelanggan', '$verification_code', 0)");
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
            window.location = "http://localhost/bikafrozen/login.php";
        </script>
    <?php
    }
    ?>
</body>

</html>