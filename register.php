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
            <h5 class="card-header bg-info">Tambah Data Pelanggan</h5>
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
if(isset($_POST['simpan'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = "Pelanggan";
    mysqli_query($koneksi,"INSERT INTO user VALUES(null,'$username','$name','$password','$level')");
    ?>
    <script>
       window.location = "http://localhost/bikafrozen/login.php";
    </script>
    <?php   
}
?>
</body>
</html>