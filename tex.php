<body>
    <div>
        <div class="sidebar p-4 bg-primary active-sidebar" id="sidebar">
            <h4 class="mb-5 text-white">BIKA FROZEN</h4>
            <li <?php if ($hal == "dashboard") { ?>class="hidup" <?php } ?>>
                <a class="text-white" href="index.php?page=dashboard">
                    <i class="fa-solid fa-home"></i>
                    Dashboard
                </a>
            </li>
            <?php
            if ($_SESSION['level'] == "Pelanggan") {
            ?>
                <li <?php if ($hal == "pelanggan"  || $hal == "edit_pelanggan") { ?>class="hidup" <?php } ?>>
                    <a class="text-white" href="index.php?page=edit_pelanggan&id=<?= $_SESSION['id'] ?>">
                        <i class="fa-solid fa-user"></i>
                        Pelanggan
                    </a>
                </li>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['level'] == "Admin") {
            ?>
                <a class="dropdown-btn text-white" href="#">
                    <i class="fa-solid fa-gear"></i>
                    Data Master
                </a>
                <div class="dropdown-container">
                    <li <?php if ($hal == "kategori" || $hal == "tambah_kategori" || $hal == "edit_kategori") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=kategori">
                            <i class="fa-solid fa-list"></i>
                            Kategori
                        </a>
                    </li>
                    <li <?php if ($hal == "pelanggan"  || $hal == "edit_pelanggan") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=pelanggan">
                            <i class="fa-solid fa-user"></i>
                            Pelanggan
                        </a>
                    </li>
                    <li <?php if ($hal == "barang" || $hal == "tambah_barang" || $hal == "edit_barang") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=barang">
                            <i class="fa-solid fa-box"></i>
                            Barang
                        </a>
                    </li>
                    <li <?php if ($hal == "ongkir" || $hal == "tambah_ongkir" || $hal == "edit_ongkir") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=ongkir">
                            <i class="fa-solid fa-truck-fast"></i>
                            Ongkir
                        </a>
                    </li>
                    <li <?php if ($hal == "kurir" || $hal == "tambah_kurir" || $hal == "edit_kurir") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=kurir">
                            <i class="fa-solid fa-truck-front"></i>
                            Kurir
                        </a>
                    </li>
                    <li <?php if ($hal == "supplier" || $hal == "tambah_supplier" || $hal == "edit_supplier") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=supplier">
                            <i class="fa-solid fa-truck-field-un"></i>
                            Supplier
                        </a>
                    </li>
                    <li <?php if ($hal == "link_live" || $hal == "tambah_link_live" || $hal == "edit_link_live") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=link_live">
                            <i class="fa-brands fa-youtube"></i>
                            Youtube
                        </a>
                    </li>
                </div>
            <?php
            }
            ?>
            <li <?php if ($hal == "menu" || $hal == "order" || $hal == "edit_menu") { ?>class="hidup" <?php } ?>>
                <a class="text-white" href="index.php?page=menu">
                    <i class="fa-solid fa-table"></i>
                    Menu
                </a>
            </li>
            <?php
            if ($_SESSION['level'] == "Admin") {
            ?>
                <li <?php if ($hal == "barang_keluar") { ?>class="hidup" <?php } ?>>
                    <a class="text-white" href="index.php?page=barang_keluar">
                        <i class="fa-solid fa-truck-ramp-box"></i>
                        Barang Keluar
                    </a>
                </li>
                <li <?php if ($hal == "barang_masuk" || $hal == "tambah_barang_masuk" || $hal == "edit_barang_masuk") { ?>class="hidup" <?php } ?>>
                    <a class="text-white" href="index.php?page=barang_masuk">
                        <i class="fa-solid fa-boxes-packing"></i>
                        Barang Masuk
                    </a>
                </li>
                <li <?php if ($hal == "barang_rusak" || $hal == "barang_baik" || $hal == "tambah_barang_rusak" || $hal == "edit_barang_rusak") { ?>class="hidup" <?php } ?>>
                    <a class="text-white" href="index.php?page=barang_rusak">
                        <i class="fa-solid fa-boxes-packing"></i>
                        Barang Rusak
                    </a>
                </li>
            <?php
            }
            ?>
            <?php
            if ($_SESSION['level'] == "Admin") {
            ?>
                <a class="dropdown-btn text-white" href="#">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    kas
                </a>
                <div class="dropdown-container">
                    <li <?php if ($hal == "transaksi_harian" || $hal == "tambah_transaksi_harian" || $hal == "edit_transaksi_harian") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=transaksi_harian">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            Transaksi Harian
                        </a>
                    </li>
                    <li <?php if ($hal == "ringkasan_kas" || $hal == "tambah_ringkasan_kas" || $hal == "edit_ringkasan_kas") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=ringkasan_kas">
                            <i class="fa-solid fa-receipt"></i>
                            Ringkasan Kas
                        </a>
                    </li>
                    <li <?php if ($hal == "penjualan"  || $hal == "edit_penjualan") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=penjualan">
                            <i class="fa-solid fa-sack-dollar"></i>
                            Penjualan
                        </a>
                    </li>
                    <li <?php if ($hal == "kewajiban"  || $hal == "edit_kewajiban") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=kewajiban">
                            <i class="fa-solid fa-rocket"></i>
                            Kewajiban
                        </a>
                    </li>
                    <li <?php if ($hal == "piutang" || $hal == "tambah_piutang" || $hal == "edit_piutang") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=piutang">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            Piutang
                        </a>
                    </li>
                    <li <?php if ($hal == "gaji" || $hal == "tambah_gaji" || $hal == "edit_gaji") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=gaji">
                            <i class="fa-solid fa-wallet"></i>
                            Gaji
                        </a>
                    </li>
                    <li <?php if ($hal == "transaksi_lainnya" || $hal == "tambah_transaksi_lainnya" || $hal == "edit_transaksi_lainnya") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=transaksi_lainnya">
                            <i class="fa-solid fa-scroll"></i>
                            Transaksi Lainnya
                        </a>
                    </li>
                </div>
            <?php
            }
            ?>
            <li <?php if ($hal == "history" || $hal == "tambah_history" || $hal == "edit_history") { ?>class="hidup" <?php } ?>>
                <a class="text-white" href="index.php?page=history">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    History
                </a>
            </li>
            <a class="dropdown-btn text-white" href="#">
                <i class="fa-solid fa-bars"></i>
                Laporan
            </a>
            <div class="dropdown-container">
                <?php
                if ($_SESSION['level'] == "Admin") {
                ?>
                    <li <?php if ($hal == "laporan_stok_barang") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=laporan_stok_barang">
                            <i class="fa-solid fa-box"></i>
                            Laporan Stok Barang
                        </a>
                    </li>
                    <li <?php if ($hal == "laporan_barang_keluar") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=laporan_barang_keluar">
                            <i class="fa-solid fa-boxes-packing"></i>
                            Barang Keluar
                        </a>
                    </li>
                    <li <?php if ($hal == "laporan_barang_masuk") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=laporan_barang_masuk">
                            <i class="fa-solid fa-truck-ramp-box"></i>
                            Barang Masuk
                        </a>
                    </li>
                    <li <?php if ($hal == "laporan_barang_rusak") { ?>class="hidup" <?php } ?>>
                        <a class="text-white" href="index.php?page=laporan_barang_rusak">
                            <i class="fa-solid fa-truck-ramp-box"></i>
                            Barang Rusak
                        </a>
                    </li>
                <?php
                }
                ?>
                <li <?php if ($hal == "laporan_history") { ?>class="hidup" <?php } ?>>
                    <a class="text-white" href="index.php?page=laporan_history">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        History
                    </a>
                </li>
            </div>
            <li>
                <a class="text-white" href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
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
            <?php
            if ($_SESSION['level'] == "Admin") {
            ?>
                <div class="notifications col-1">
                    <button class="notification-button" onclick="toggleDropdown()">
                        <span class="bell-icon">🔔</span>
                        <?php
                        include "koneksi.php";
                        $countNotif = mysqli_query($koneksi, "SELECT COUNT(jumlah) as jumlah FROM `barang` WHERE jumlah < 15");
                        $cn = mysqli_fetch_assoc($countNotif);
                        ?>
                        <span class="badge"><?= $cn['jumlah'] ?></span>
                    </button>
                    <div class="dropdown-menu" id="notification-dropdown">
                        <div class="dropdown-header">
                            <span>Notifications</span>
                            <span class="clear" onclick="clearNotifications()">Clear All</span>
                        </div>
                        <div class="dropdown-content">
                            <?php
                            include "koneksi.php";
                            $queryNotif = mysqli_query($koneksi, "SELECT DISTINCT(jumlah), nm_barang FROM `barang` WHERE jumlah < 15");
                            while ($data = mysqli_fetch_array($queryNotif)) {
                            ?>
                                <a href="#">Barang: <?php echo $data['nm_barang']; ?> tinggal <?php echo $data['jumlah']; ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="col-10">
                <h1 style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                    <?= $hal ?></h1>
            </div>
        </div>
        </div>
        <hr>
        <div class="">
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
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('notification-dropdown');
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            } else {
                dropdown.style.display = 'block';
            }
        }

        function clearNotifications() {
            var dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.innerHTML = '<a href="#">No new notifications</a>';
            var badge = document.querySelector('.badge');
            badge.style.display = 'none';
        }

        window.onclick = function(event) {
            if (!event.target.matches('.notification-button')) {
                var dropdown = document.getElementById('notification-dropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>

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
    </script>

    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</body>