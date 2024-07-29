<?php
include "koneksi.php";
$hal = $_GET['page'];
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:login.php?pesan=gagal");
}
$id = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_user = '$id'");
$row = mysqli_fetch_assoc($query);
?>

<?php
if (empty($row['id_pelanggan'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>BIKA FROZEN FOOD</title>
        <!-- bootstrap 5 css -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <script src="https://kit.fontawesome.com/a284c48079.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <style>
        li {
            list-style: none;
            margin: 20px 0 20px 0;
        }

        .hidup {
            background-color: blueviolet;
            border-radius: 10px;
            font-size: 20px;
            width: 200px;

        }

        a {
            text-decoration: none;
            margin: 10px;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: 0.4s;
        }

        .active-main-content {
            margin-left: 250px;
        }

        .active-sidebar {
            margin-left: 0;
        }

        .dropdown-container {
            display: none;
            padding-left: 8px;
        }


        #main-content {
            transition: 0.4s;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: white;
        }

        .logo {
            font-size: 24px;
        }

        .notifications {
            position: relative;
        }

        .notification-button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            position: relative;
        }

        .bell-icon {
            font-size: 24px;
        }

        .badge {
            position: absolute;
            top: 0;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background-color: white;
            color: black;
            border: 1px solid #ddd;
            width: 250px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .dropdown-header {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #f1f1f1;
        }

        .clear {
            color: blue;
            cursor: pointer;
        }

        .dropdown-content {
            max-height: 300px;
            overflow-y: auto;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>

    <body>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col-11">
                            <h2>Tambah Data Pelanggan</h2>
                        </div>
                        <div class="col-1">
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div>
                            <input type="hidden" value="<?= $_SESSION['id'] ?>" name="id_user">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" autofocus required>
                        </div>
                        <div class="row">
                            <label for="">TTL</label>
                            <div class="col-6">
                                <input type="text" class="form-control" name="tempat" required>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" name="tgl" required>
                            </div>
                        </div>
                        <div>
                            <label for="">Provensi</label>
                            <input type="text" class="form-control" name="provensi" autofocus required>
                        </div>
                        <div>
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" autofocus required>
                        </div>
                        <div>
                            <label for="">kelurahan</label>
                            <input type="text" class="form-control" name="kelurahan" autofocus required>
                        </div>
                        <div>
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" autofocus required>
                        </div>
                        <div>
                            <label for="">No Hp</label>
                            <input type="text" class="form-control" name="no_hp" autofocus required>
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
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $tempat = $_POST['tempat'];
            $tgl = $_POST['tgl'];
            $provensi = $_POST['provensi'];
            $kecamatan = $_POST['kecamatan'];
            $kelurahan = $_POST['kelurahan'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $id_user = $_POST['id_user'];

            mysqli_query($koneksi, "INSERT INTO pelanggan VALUES(null,'$id_user','$nama','$tempat','$tgl','$alamat','$no_hp','$provensi','$kecamatan','$kelurahan')");
        ?>
            <script>
                swal({
                    title: "Success!",
                    text: "Tambah data berhasil",
                    type: "success"
                }, setTimeout(function() {

                    window.location.href = "http://localhost/bikafrozen/index.php?page=dashboard";

                }, 1000));
            </script>
        <?php
        }
        ?>
    </body>

    </html>
<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Bika FROZENFOOD</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

        <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="index.php?page=dashboard" class="logo d-flex align-items-center">
                    <span class="d-none d-lg-block">BIKA FROZEN FOOD</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item d-block d-lg-none">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            <i class="bi bi-search"></i>
                        </a>
                    </li><!-- End Search Icon-->

                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <?php
                            include "koneksi.php";
                            $countNotif = mysqli_query($koneksi, "SELECT COUNT(jumlah) as jumlah FROM `barang` WHERE jumlah < 15");
                            $cn = mysqli_fetch_assoc($countNotif);
                            ?>
                            <span class="badge bg-primary badge-number"><?= $cn['jumlah'] ?></span>
                        </a><!-- End Notification Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have <?= $cn['jumlah'] ?> new notifications
                                <a href="index.php?page=barang"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php
                            include "koneksi.php";
                            $queryNotif = mysqli_query($koneksi, "SELECT DISTINCT(jumlah), nm_barang FROM `barang` WHERE jumlah < 15");
                            while ($data = mysqli_fetch_array($queryNotif)) {
                            ?>
                                <li class="notification-item">
                                    <i class="bi bi-x-circle text-danger"></i>
                                    <a href="index.php?page=barang">
                                        <p class="text-dark">Barang: <?php echo $data['nm_barang']; ?> tinggal <?php echo $data['jumlah']; ?></p>
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php
                            }
                            ?>
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>

                        </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->

                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-chat-left-text"></i>
                            <?php
                            include "koneksi.php";
                            $id_user = $_SESSION['id'];
                            if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
                                $countNotif = mysqli_query($koneksi, "SELECT COUNT(pembayaran) as notfi_pembayaran FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.id_pelanggan JOIN user ON pelanggan.id_user = user.id where pembayaran >1");
                            } else {
                                $countNotif = mysqli_query($koneksi, "SELECT COUNT(pembayaran) as notfi_pembayaran FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.id_pelanggan JOIN user ON pelanggan.id_user = user.id WHERE pelanggan.id_user = $id_user AND pembayaran >1");
                            }

                            $cn = mysqli_fetch_assoc($countNotif);
                            ?>
                            <span class="badge bg-success badge-number"><?= $cn['notfi_pembayaran'] ?></span>
                        </a><!-- End Notification Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have <?= $cn['notfi_pembayaran'] ?> new notifications
                                <a href="index.php?page=history"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php
                            include "koneksi.php";
                            if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
                                $queryNotif = mysqli_query($koneksi, "SELECT `order`.* FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.id_pelanggan JOIN user ON pelanggan.id_user = user.id ORDER BY `order`.tgl DESC, `order`.pembayaran DESC");
                            } else {
                                $queryNotif = mysqli_query($koneksi, "SELECT `order`.* FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.id_pelanggan JOIN user ON pelanggan.id_user = user.id WHERE pelanggan.id_user = $id_user ORDER BY `order`.tgl DESC, `order`.pembayaran DESC");
                            }
                            while ($data = mysqli_fetch_array($queryNotif)) {
                                // echo $data['pembayaran'];
                            ?>
                                <?php
                                if ($data['pembayaran'] == 3) {
                                ?>
                                    <li class="notification-item">
                                        <i class="bi bi-info-circle text-primary"></i>
                                        <a href="index.php?page=menu&id_order= <?= $data['id_order'] ?>">
                                            <p class="text-dark">Pesanan anda tanggal <?= $data['tgl'] ?> dengan total <?= "Rp " . number_format($data['harga'], 0, ',', '.'); ?> Sedang dikirim</p>
                                        </a>
                                    </li>
                                <?php
                                } else
                                if ($data['pembayaran'] == 4) {
                                ?>
                                    <li class="notification-item">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <a href="index.php?page=menu&id_order= <?= $data['id_order'] ?>">
                                            <p class="text-dark">Pesanan anda tanggal <?= $data['tgl'] ?> dengan total <?= "Rp " . number_format($data['harga'], 0, ',', '.'); ?> Telah diterima</p>
                                        </a>
                                    </li>
                                <?php
                                } else
                                if ($data['pembayaran'] == 5) {
                                ?>
                                    <li class="notification-item">
                                        <i class="bi bi-x-circle text-danger"></i>
                                        <a href="index.php?page=menu&id_order= <?= $data['id_order'] ?>">
                                            <p class="text-dark">Pesanan pada tanggal <?= $data['tgl'] ?> dengan total <?= "Rp " . number_format($data['harga'], 0, ',', '.'); ?> ada rusak</p>
                                        </a>
                                    </li>
                                <?php
                                } else
                                if ($data['pembayaran'] == 6) {
                                ?>
                                    <li class="notification-item">
                                        <i class="bi bi-exclamation-circle text-warning"></i>
                                        <a href="index.php?page=history">
                                            <p class="text-dark">Pesanan anda tanggal <?= $data['tgl'] ?> dengan total <?= "Rp " . number_format($data['harga'], 0, ',', '.'); ?> Telah diganti</p>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php
                            }
                            ?>
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>

                        </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->


                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['username'] ?></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link <?php if ($hal != "dashboard") {
                                            echo "collapsed";
                                        } ?>" href="index.php?page=dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->
                <?php
                if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "Super Admin") {
                ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($hal != "pelanggan" || $hal != "edit_pelanggan") {
                                                echo "collapsed";
                                            } ?>" href="index.php?page=edit_pelanggan&id=<?= $_SESSION['id'] ?>">
                            <i class="bi bi-person"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                <?php
                if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
                ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a <?php if ($hal == "kategori" || $hal == "tambah_kategori" || $hal == "edit_kategori") { ?>class="active" <?php } ?> href="index.php?page=kategori">
                                    <i class="bi bi-circle"></i><span>Kategori</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "pelanggan" || $hal == "tambah_pelanggan" || $hal == "edit_pelanggan") { ?>class="active" <?php } ?> href="index.php?page=pelanggan">
                                    <i class="bi bi-circle"></i><span>Pelanggan</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "barang" || $hal == "tambah_barang" || $hal == "edit_barang") { ?>class="active" <?php } ?> href="index.php?page=barang">
                                    <i class="bi bi-circle"></i><span>Barang</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "jual_beli" || $hal == "tambah_jual_beli" || $hal == "edit_jual_beli") { ?>class="active" <?php } ?> href="index.php?page=jual_beli">
                                    <i class="bi bi-circle"></i><span>Jual Beli Barang</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "ongkir" || $hal == "tambah_ongkir" || $hal == "edit_ongkir") { ?>class="active" <?php } ?> href="index.php?page=ongkir">
                                    <i class="bi bi-circle"></i><span>Ongkir</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "kurir" || $hal == "tambah_kurir" || $hal == "edit_kurir") { ?>class="active" <?php } ?> href="index.php?page=kurir">
                                    <i class="bi bi-circle"></i><span>Kurir</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "supplier" || $hal == "tambah_supplier" || $hal == "edit_supplier") { ?>class="active" <?php } ?> href="index.php?page=supplier">
                                    <i class="bi bi-circle"></i><span>Supplier</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "link_live" || $hal == "tambah_link_live" || $hal == "edit_link_live") { ?>class="active" <?php } ?> href="index.php?page=link_live">
                                    <i class="bi bi-circle"></i><span>Link Live</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-target="#kas" data-bs-toggle="collapse" href="#">
                            <i class="bi bi-journal-text"></i><span>Kas</span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="kas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                            <li>
                                <a <?php if ($hal == "transaksi_harian" || $hal == "tambah_transaksi_harian" || $hal == "edit_transaksi_harian") { ?>class="active" <?php } ?> href="index.php?page=transaksi_harian">
                                    <i class="bi bi-circle"></i><span>Transaksi Harian</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "ringkasan_kas" || $hal == "tambah_ringkasan_kas" || $hal == "edit_ringkasan_kas") { ?>class="active" <?php } ?> href="index.php?page=ringkasan_kas">
                                    <i class="bi bi-circle"></i><span>Ringkasan Kas</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "penjualan" || $hal == "tambah_penjualan" || $hal == "edit_penjualan") { ?>class="active" <?php } ?> href="index.php?page=penjualan">
                                    <i class="bi bi-circle"></i><span>Penjualan</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "kewajiban" || $hal == "tambah_kewajiban" || $hal == "edit_kewajiban") { ?>class="active" <?php } ?> href="index.php?page=kewajiban">
                                    <i class="bi bi-circle"></i><span>Kewajiban</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "piutang" || $hal == "tambah_piutang" || $hal == "edit_piutang") { ?>class="active" <?php } ?> href="index.php?page=piutang">
                                    <i class="bi bi-circle"></i><span>Piutang</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "gaji" || $hal == "tambah_gaji" || $hal == "edit_gaji") { ?>class="active" <?php } ?> href="index.php?page=gaji">
                                    <i class="bi bi-circle"></i><span>Gaji</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "transaksi_lainnya" || $hal == "tambah_transaksi_lainnya" || $hal == "edit_transaksi_lainnya") { ?>class="active" <?php } ?> href="index.php?page=transaksi_lainnya">
                                    <i class="bi bi-circle"></i><span>Transaksi Lainnya</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-heading">Pages</li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($hal != "menu" || $hal != "order" || $hal != "edit_menu") { ?>collapsed <?php } ?>" href="index.php?page=menu">
                        <i class="bi bi-person"></i>
                        <span>Menu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($hal != "barang_keluar") {
                                            echo "collapsed";
                                        } ?>" href="index.php?page=barang_keluar">
                        <i class="bi bi-archive"></i>
                        <span>Barang Keluar</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($hal != "barang_masuk") {
                                            echo "collapsed";
                                        } ?>" href="index.php?page=barang_masuk">
                        <i class="bi bi-bag-plus"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($hal != "barang_rusak") {
                                            echo "collapsed";
                                        } ?>" href="index.php?page=barang_rusak">
                        <i class="bi bi-bag-x-fill"></i>
                        <span>Barang Rusak</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($hal != "history") {
                                            echo "collapsed";
                                        } ?>" href="index.php?page=history">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <span>History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#laporan" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="laporan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <?php
                        if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
                        ?>
                            <li>
                                <a <?php if ($hal == "laporan_stok_barang") { ?>class="active" <?php } ?> href="index.php?page=laporan_stok_barang">
                                    <i class="bi bi-circle"></i><span>Laporan Stok Barang</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "laporan_barang_keluar") { ?>class="active" <?php } ?> href="index.php?page=laporan_barang_keluar">
                                    <i class="bi bi-circle"></i><span>Laporan Barang Keluar</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "laporan_barang_masuk") { ?>class="active" <?php } ?> href="index.php?page=laporan_barang_masuk">
                                    <i class="bi bi-circle"></i><span>Laporan Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a <?php if ($hal == "laporan_barang_rusak") { ?>class="active" <?php } ?> href="index.php?page=laporan_barang_rusak">
                                    <i class="bi bi-circle"></i><span>Laporan Barang Rusak</span>
                                </a>
                            </li>
                        <?php }
                        ?>
                        <li>
                            <a <?php if ($hal == "laporan_history") { ?>class="active" <?php } ?> href="index.php?page=laporan_history">
                                <i class="bi bi-circle"></i><span>Laporan History</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </aside><!-- End Sidebar-->

        <main id="main" class="main">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                switch ($page) {
                    case 'dashboard':
                        include "halaman/dashboard.php";
                        break;

                        //kategori
                    case 'kategori':
                        include "halaman/kategori/list.php";
                        break;
                    case 'tambah_kategori':
                        include "halaman/kategori/tambah.php";
                        break;
                    case 'edit_kategori':
                        include "halaman/kategori/edit.php";
                        break;
                    case 'hapus_kategori':
                        include "halaman/kategori/hapus.php";
                        break;

                        //link live
                    case 'link_live':
                        include "halaman/link_live/list.php";
                        break;
                    case 'tambah_link_live':
                        include "halaman/link_live/tambah.php";
                        break;
                    case 'edit_link_live':
                        include "halaman/link_live/edit.php";
                        break;
                    case 'hapus_link_live':
                        include "halaman/link_live/hapus.php";
                        break;

                        //komplen
                    case 'komplen':
                        include "halaman/komplen/list.php";
                        break;
                    case 'tambah_komplen':
                        include "halaman/komplen/tambah.php";
                        break;
                    case 'edit_komplen':
                        include "halaman/komplen/edit.php";
                        break;
                    case 'hapus_komplen':
                        include "halaman/komplen/hapus.php";
                        break;

                        //pelanggan
                    case 'pelanggan':
                        include "halaman/pelanggan/list.php";
                        break;
                    case 'edit_pelanggan':
                        include "halaman/pelanggan/edit.php";
                        break;
                    case 'hapus_pelanggan':
                        include "halaman/pelanggan/hapus.php";
                        break;
                    case 'blokir_pelanggan':
                        include "halaman/pelanggan/blokir.php";
                        break;

                        //barang
                    case 'barang':
                        include "halaman/barang/list.php";
                        break;
                    case 'tambah_barang':
                        include "halaman/barang/tambah.php";
                        break;
                    case 'edit_barang':
                        include "halaman/barang/edit.php";
                        break;
                    case 'hapus_barang':
                        include "halaman/barang/hapus.php";
                        break;
                    case 'laporan_stok_barang':
                        include "halaman/barang/laporan.php";
                        break;
                        //jual beli
                    case 'jual_beli':
                        include "halaman/jual_beli/list.php";
                        break;
                    case 'tambah_jual_beli':
                        include "halaman/jual_beli/tambah.php";
                        break;
                    case 'edit_jual_beli':
                        include "halaman/jual_beli/edit.php";
                        break;
                    case 'hapus_jual_beli':
                        include "halaman/jual_beli/hapus.php";
                        break;
                    case 'laporan_stok_jual_beli':
                        include "halaman/jual_beli/laporan.php";
                        break;

                        //menu
                    case 'menu':
                        include "halaman/menu/list.php";
                        break;
                    case 'order':
                        include "halaman/menu/order.php";
                        break;
                    case 'edit_menu':
                        include "halaman/menu/edit.php";
                        break;
                    case 'hapus_menu':
                        include "halaman/menu/hapus.php";
                        break;

                        //barang keluar
                    case 'barang_keluar':
                        include "halaman/barang_keluar/list.php";
                        break;
                    case 'laporan_barang_keluar':
                        include "halaman/barang_keluar/laporan.php";
                        break;

                        //Ongkir
                    case 'ongkir':
                        include "halaman/ongkir/list.php";
                        break;
                    case 'tambah_ongkir':
                        include "halaman/ongkir/tambah.php";
                        break;
                    case 'edit_ongkir':
                        include "halaman/ongkir/edit.php";
                        break;
                    case 'hapus_ongkir':
                        include "halaman/ongkir/hapus.php";
                        break;

                        //kurir
                    case 'kurir':
                        include "halaman/kurir/list.php";
                        break;
                    case 'tambah_kurir':
                        include "halaman/kurir/tambah.php";
                        break;
                    case 'edit_kurir':
                        include "halaman/kurir/edit.php";
                        break;
                    case 'hapus_kurir':
                        include "halaman/kurir/hapus.php";
                        break;

                        //supplier
                    case 'supplier':
                        include "halaman/supplier/list.php";
                        break;
                    case 'tambah_supplier':
                        include "halaman/supplier/tambah.php";
                        break;
                    case 'edit_supplier':
                        include "halaman/supplier/edit.php";
                        break;
                    case 'hapus_supplier':
                        include "halaman/supplier/hapus.php";
                        break;
                    case 'laporan_supplier':
                        include "halaman/supplier/laporan.php";
                        break;

                        //Barang Masuk
                    case 'barang_masuk':
                        include "halaman/barang_masuk/list.php";
                        break;
                    case 'tambah_barang_masuk':
                        include "halaman/barang_masuk/tambah.php";
                        break;
                    case 'edit_barang_masuk':
                        include "halaman/barang_masuk/edit.php";
                        break;
                    case 'hapus_barang_masuk':
                        include "halaman/barang_masuk/hapus.php";
                        break;
                    case 'laporan_barang_masuk':
                        include "halaman/barang_masuk/laporan.php";
                        break;

                        //barang Rusak
                    case 'barang_rusak':
                        include "halaman/barang_rusak/list.php";
                        break;
                    case 'tambah_barang_rusak':
                        include "halaman/barang_rusak/tambah.php";
                        break;
                    case 'edit_barang_rusak':
                        include "halaman/barang_rusak/edit.php";
                        break;
                    case 'barang_baik':
                        include "halaman/barang_rusak/baik.php";
                        break;
                    case 'hapus_barang_rusak':
                        include "halaman/barang_rusak/hapus.php";
                        break;
                    case 'laporan_barang_rusak':
                        include "halaman/barang_rusak/laporan.php";
                        break;
                        //history
                    case 'history':
                        include "halaman/history/list.php";
                        break;
                    case 'laporan_history':
                        include "halaman/history/laporan.php";
                        break;
                    case 'edit_history':
                        include "halaman/history/edit.php";
                        break;
                    case 'hapus_history':
                        include "halaman/history/hapus.php";
                        break;
                    case 'bayar':
                        include "halaman/history/bayar.php";
                        break;
                    case 'terima':
                        include "halaman/history/terima.php";
                        break;
                    case 'retur':
                        include "halaman/history/retur.php";
                        break;

                        //kas
                        //Transaksi harian
                    case 'transaksi_harian':
                        include "halaman/kas/transaksi_harian/list.php";
                        break;

                        //Ringkasan kas
                    case 'ringkasan_kas':
                        include "halaman/kas/ringkasan_kas/list.php";
                        break;

                        //penjuaan
                    case 'penjualan':
                        include "halaman/kas/penjualan/list.php";
                        break;
                    case 'tambah_penjualan':
                        include "halaman/kas/penjualan/tambah.php";
                        break;
                    case 'edit_penjualan':
                        include "halaman/kas/penjualan/edit.php";
                        break;
                    case 'hapus_penjualan':
                        include "halaman/kas/penjualan/hapus.php";
                        break;
                    case 'verifikasi_penjualan':
                        include "halaman/kas/penjualan/verifikasi.php";
                        break;

                        //kewajiban
                    case 'kewajiban':
                        include "halaman/kas/kewajiban/list.php";
                        break;
                    case 'tambah_kewajiban':
                        include "halaman/kas/kewajiban/tambah.php";
                        break;
                    case 'edit_kewajiban':
                        include "halaman/kas/kewajiban/edit.php";
                        break;
                    case 'hapus_kewajiban':
                        include "halaman/kas/kewajiban/hapus.php";
                        break;
                    case 'verifikasi_kewajiban':
                        include "halaman/kas/kewajiban/verifikasi.php";
                        break;

                        //piutang
                    case 'piutang':
                        include "halaman/kas/piutang/list.php";
                        break;
                    case 'tambah_piutang':
                        include "halaman/kas/piutang/tambah.php";
                        break;
                    case 'edit_piutang':
                        include "halaman/kas/piutang/edit.php";
                        break;
                    case 'hapus_piutang':
                        include "halaman/kas/piutang/hapus.php";
                        break;
                    case 'verifikasi_piutang':
                        include "halaman/kas/piutang/verifikasi.php";
                        break;

                        //Gaji
                    case 'gaji':
                        include "halaman/kas/gaji/list.php";
                        break;
                    case 'tambah_gaji':
                        include "halaman/kas/gaji/tambah.php";
                        break;
                    case 'edit_gaji':
                        include "halaman/kas/gaji/edit.php";
                        break;
                    case 'hapus_gaji':
                        include "halaman/kas/gaji/hapus.php";
                        break;
                    case 'verifikasi_gaji':
                        include "halaman/kas/gaji/verifikasi.php";
                        break;

                    case 'transaksi_lainnya':
                        include "halaman/kas/transaksi_lainnya/list.php";
                        break;
                    case 'tambah_transaksi_lainnya':
                        include "halaman/kas/transaksi_lainnya/tambah.php";
                        break;
                    case 'edit_transaksi_lainnya':
                        include "halaman/kas/transaksi_lainnya/edit.php";
                        break;
                    case 'hapus_transaksi_lainnya':
                        include "halaman/kas/transaksi_lainnya/hapus.php";
                        break;
                    case 'verifikasi_transaksi_lainnya':
                        include "halaman/kas/transaksi_lainnya/verifikasi.php";
                        break;


                    default:
                        echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                        break;
                }
            } else {
                include "halaman/dashboard.php";
            }

            ?>
        </main><!-- End #main -->


        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>
        <script type="text/javascript">
            var rupiah = document.getElementById('rupiah');
            rupiah.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            var rupiah1 = document.getElementById('rupiah1');
            rupiah1.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah1() untuk mengubah angka yang di ketik menjadi format angka
                rupiah1.value = formatRupiah1(this.value, 'Rp. ');
            });

            /* Fungsi formatRupiah1 */
            function formatRupiah1(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah1 = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah1 += separator + ribuan.join('.');
                }

                rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
                return prefix == undefined ? rupiah1 : (rupiah1 ? 'Rp. ' + rupiah1 : '');
            }
        </script>
    </body>

    </html>
<?php
}
?>