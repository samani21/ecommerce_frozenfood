<?php
    $hal = $_GET['page'];
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
</head>
<style>
    li {
        list-style: none;
        margin: 20px 0 20px 0;
    }
    .hidup{
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
<body>
    <div>
        <div class="sidebar p-4 bg-primary active-sidebar" id="sidebar">
            <h4 class="mb-5 text-white">BIKA FROZEN</h4>
            <li <?php if($hal == "dashboard"){ ?>class="hidup"<?php }?>>
                <a class="text-white" href="index.php?page=dashboard">
                    <i class="bi bi-house mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li <?php if($hal == "kategori" || $hal == "tambah_kategori" || $hal == "edit_kategori"){ ?>class="hidup"<?php }?>>
                <a class="text-white" href="index.php?page=kategori">
                    <i class="bi bi-house mr-2"></i>
                    Kategori
                </a>
            </li>
            <li <?php if($hal == "barang" || $hal == "tambah_barang" || $hal == "edit_barang"){ ?>class="hidup"<?php }?>>
                <a class="text-white" href="index.php?page=barang">
                    <i class="bi bi-house mr-2"></i>
                    Barang
                </a>
            </li>
            <li <?php if($hal == "menu" || $hal == "order" || $hal == "edit_menu"){ ?>class="hidup"<?php }?>>
                <a class="text-white" href="index.php?page=menu">
                    <i class="bi bi-house mr-2"></i>
                    Menu
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
                <h1 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"><?= $hal?></h1>
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
</body>

</html>