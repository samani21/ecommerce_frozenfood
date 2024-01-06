<?php
    include "koneksi.php";
    $hal = $_GET['page'];
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:login.php?pesan=gagal");
	}
    $id = $_SESSION['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_user = '$id'");
    $row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap Demo</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
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

    #main-content {
        transition: 0.4s;
    }
</style>
<?php
    if(empty($row['id_pelanggan'])){
        ?>

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
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" autofocus required>
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
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $tempat = $_POST['tempat'];
    $tgl = $_POST['tgl'];
    $alamat = $_POST['alamat'];
    $id_user = $_POST['id_user'];

    mysqli_query($koneksi,"INSERT INTO pelanggan VALUES(null,'$id_user','$nama','$tempat','$tgl','$alamat')");
    ?>
    <script>
        swal({
title: "Success!",
text: "Tambah data berhasil",
type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=dashboard";

}, 1000));
    </script>
    <?php   
}
?>
</body>
<?php
    }else{
        ?>

<body>
    <div>
        <div class="sidebar p-4 bg-primary active-sidebar" id="sidebar">
            <h4 class="mb-5 text-white">BIKA FROZEN</h4>
            <li <?php if($hal == "dashboard"){ ?>class="hidup" <?php }?>>
                <a class="text-white" href="index.php?page=dashboard">
                    <i class="bi bi-house mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li <?php if($hal == "kategori" || $hal == "tambah_kategori" || $hal == "edit_kategori"){ ?>class="hidup"
                <?php }?>>
                <a class="text-white" href="index.php?page=kategori">
                    <i class="bi bi-house mr-2"></i>
                    Kategori
                </a>
            </li>
            <li <?php if($hal == "pelanggan"  || $hal == "edit_pelanggan"){ ?>class="hidup"
                <?php }?>>
                <a class="text-white" href="index.php?page=pelanggan">
                    <i class="bi bi-house mr-2"></i>
                    Pelanggan
                </a>
            </li>
            <li <?php if($hal == "barang" || $hal == "tambah_barang" || $hal == "edit_barang"){ ?>class="hidup"
                <?php }?>>
                <a class="text-white" href="index.php?page=barang">
                    <i class="bi bi-house mr-2"></i>
                    Barang
                </a>
            </li>
            <li <?php if($hal == "menu" || $hal == "order" || $hal == "edit_menu"){ ?>class="hidup" <?php }?>>
                <a class="text-white" href="index.php?page=menu">
                    <i class="bi bi-house mr-2"></i>
                    Menu
                </a>
            </li>
            <li <?php if($hal == "barang_keluar"){ ?>class="hidup" <?php }?>>
                <a class="text-white" href="index.php?page=barang_keluar">
                    <i class="bi bi-house mr-2"></i>
                    Barang Keluar
                </a>
            </li>
            <li <?php if($hal == "ongkir" || $hal == "tambah_ongkir" || $hal == "edit_ongkir"){ ?>class="hidup"
                <?php }?>>
                <a class="text-white" href="index.php?page=ongkir">
                    <i class="bi bi-house mr-2"></i>
                    Ongkir
                </a>
            </li>
            <li <?php if($hal == "barang_masuk" || $hal == "tambah_barang_masuk" || $hal == "edit_barang_masuk"){ ?>class="hidup"
                <?php }?>>
                <a class="text-white" href="index.php?page=barang_masuk">
                    <i class="bi bi-house mr-2"></i>
                    Barang Masuk
                </a>
            </li>
            <li>
                <a class="text-white" href="logout.php">
                    <i class="bi bi-house mr-2"></i>
                    Logout
                </a>
            </li>
        </div>
    </div>
    <section class="p-4 active-main-content" id="main-content">
        <div class="row">
            <div class="col-1">
                <button class="btn btn-primary" id="button-toggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            <div class="col-11">
                <h1
                    style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                    <?= $hal?></h1>
            </div>
        </div>
        <hr>
        <div class="">
            <?php 
	if(isset($_GET['page'])){
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
			default:
				echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
				break;
		}
	}else{
		include "halaman/dashboard.php";
	}
 
	 ?>
        </div>
    </section>
    <script>
        // event will be executed when the toggle-button is clicked
        document.getElementById("button-toggle").addEventListener("click", () => {

            // when the button-toggle is clicked, it will add/remove the active-sidebar class
            document.getElementById("sidebar").classList.toggle("active-sidebar");

            // when the button-toggle is clicked, it will add/remove the active-main-content class
            document.getElementById("main-content").classList.toggle("active-main-content");
        });
    </script>
    <script>
        new DataTable('#example');
    </script>
    <script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>
</body>
<?php
    }
?>

</html>