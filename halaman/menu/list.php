<?php
include "././koneksi.php";
$pa = $_GET['page'];
@$id_k = substr($_GET['id_kategori'], 0, 4);
@$kategori = $_GET['id_kategori'];
@$order = $_GET['id_order'];
$query1 = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<div class="row">
    <div class="col-9">
        <form action="" method="get">
            <div class="row">
                <input type="hidden" name="page" value="<?= $pa ?>" class="form-control" required>
                <input type="hidden" name="halaman" value="1" class="form-control" required>
                <input type="hidden" name="id_order" value="<?= $order ?>" class="form-control" required>
                <div class="col-6">
                    <select name="id_kategori" class="form-control" id="">
                        <option value="">Semua</option>
                        <?php
                        while ($row1 = mysqli_fetch_array($query1)) {
                        ?>
                            <option value="<?php
                                            if ($row1['id_kategori'] < 10) {
                                                echo "000" . $row1['id_kategori'];
                                            } else if ($row1['id_kategori'] < 100) {
                                                echo "00" . $row1['id_kategori'];
                                            } else if ($row1['id_kategori'] < 1000) {
                                                echo "0" . $row1['id_kategori'];
                                            } else if ($row1['id_kategori'] < 10000) {
                                                echo $row1['id_kategori'];
                                            }
                                            ?>, <?= $row1['nm_kategori'] ?>"><?php
                                                                                if ($row1['id_kategori'] < 10) {
                                                                                    echo "000" . $row1['id_kategori'];
                                                                                } else if ($row1['id_kategori'] < 100) {
                                                                                    echo "00" . $row1['id_kategori'];
                                                                                } else if ($row1['id_kategori'] < 1000) {
                                                                                    echo "0" . $row1['id_kategori'];
                                                                                } else if ($row1['id_kategori'] < 10000) {
                                                                                    echo $row1['id_kategori'];
                                                                                }
                                                                                ?>, <?= $row1['nm_kategori'] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-2">
        <?php
        if (empty($order)) {
            if ($_SESSION['level'] == "Admin") {
            } else {
        ?>
                <div align="right">
                    <a href="index.php?page=order" class="btn btn-warning">Order</a>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-6">
        <?php
        $batas = 5;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

        $previous = $halaman - 1;
        $next = $halaman + 1;
        if (empty($id_k)) {
            $data = mysqli_query($koneksi, "SELECT barang.id_barang,barang.nm_barang,barang.jumlah,barang.foto,barang.foto,kategori.nm_kategori,jual_beli.jual as harga FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori LEFT JOIN jual_beli ON jual_beli.id_barang = barang.id_barang");
        } else {
            $data = mysqli_query($koneksi, "SELECT barang.id_barang,barang.nm_barang,barang.jumlah,barang.foto,barang.foto,kategori.nm_kategori,jual_beli.jual as harga FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori LEFT JOIN jual_beli ON jual_beli.id_barang = barang.id_barang WHERE barang.id_kategori = '$id_k'");
        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        if (empty($id_k)) {
            $query = mysqli_query($koneksi, "SELECT barang.id_barang,barang.nm_barang,barang.jumlah,barang.foto,barang.foto,kategori.nm_kategori,jual_beli.jual as harga FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori LEFT JOIN jual_beli ON jual_beli.id_barang = barang.id_barang limit $halaman_awal, $batas");
        } else {
            $query = mysqli_query($koneksi, "SELECT barang.id_barang,barang.nm_barang,barang.jumlah,barang.foto,barang.foto,kategori.nm_kategori,jual_beli.jual as harga FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori LEFT JOIN jual_beli ON jual_beli.id_barang = barang.id_barang WHERE barang.id_kategori = '$id_k' limit $halaman_awal, $batas");
        }
        $nomor = $halaman_awal + 1;
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="card">
                <div class="card-header bg-info text-dark">
                    <div class="row">
                        <div class="col-6">
                            <h5><?= $nomor++  ?>. <?= $row['nm_barang'] ?></h5>
                        </div>
                        <div class="col-3">
                            <h5><?= $row['nm_kategori'] ?></h5>
                        </div>
                        <div class="col-3">
                            <h5><?php if (isset($row['harga'])) {
                                    echo $hasil_rupiah = "Rp " . number_format($row['harga'], 0, ',', '.');
                                } ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <td width="40%"><img src="././file/<?= $row['foto'] ?>" alt="" width="40%"></td>
                        <td width="30%">Stok <?= $row['jumlah'] ?></< /td>
                        <td width="30%">
                            <?php
                            if (empty($order)) {
                            } else {
                            ?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="number" name="jumlah" class="form-control" required>
                                            <input type="hidden" name="harga" value="<?= $row['harga'] ?>" class="form-control" required>
                                            <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>" class="form-control" required>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary" type="submit" name="simpan1">Pesan</button>
                                        </div>
                                    </div>
                                </form>
                            <?php

                            }
                            ?>
                        </td>
                    </table>
                </div>
            </div>
            <br>
        <?php
        }
        ?>
        <nav>
            <ul class="pagination justify-content">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='?page=menu&halaman=$previous&id_kategori=$kategori&id_order=$order'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?page=menu&halaman=<?php echo $x ?>&id_kategori=<?= $kategori ?>&id_order=<?= $order ?>"><?php echo $x; ?></a>
                    </li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                echo "href='?page=menu&halaman=$next&id_kategori=$kategori&id_order=$order'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-6">
        <?php
        if (empty($order)) {
        } else {
        ?>
            <div class="card">
                <div class="card-header bg-info text-dark">
                    <div class="row">
                        <div class="col-6">
                            <h5> Nama Barang<h5>
                        </div>
                        <div class="col-3">
                            <h5>Jumlah</h5>
                        </div>
                        <div class="col-3">
                            <h5>Harga</h5>
                        </div>
                    </div>
                </div>
                <?php
                $pesan = mysqli_query($koneksi, "SELECT pesanan.jumlah as total_p ,pesanan.*,barang.id_barang,barang.nm_barang,barang.foto,jual_beli.jual as harga,kategori.* FROM pesanan JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori LEFT JOIN jual_beli ON jual_beli.id_barang = barang.id_barang WHERE pesanan.id_order = '$order'");
                $total = mysqli_query($koneksi, "SELECT order.foto as foto_pembayaran,SUM(pesanan.jumlah*pesanan.harga) as subtotal, `order`.harga as harga_total,`order`.id_ongkir as ongkir, ongkir.harga as harga_ongkir,ongkir.kota as kota,`order`.alamat,`order`.pembayaran FROM `pesanan` JOIN `order` ON `order`.`id_order`= `pesanan`.`id_order` JOIN ongkir ON ongkir.id_ongkir = `order`.id_ongkir WHERE `order`.`id_order`= '$order'");
                $subtotal = mysqli_fetch_array($total);

                $total_kes = mysqli_query($koneksi, "SELECT SUM(jumlah*harga) as totl FROM `pesanan` WHERE id_order = '$order'");
                $subtotal_kes = mysqli_fetch_array($total_kes);
                while ($row_pesan = mysqli_fetch_array($pesan)) {
                ?>

                    <div class="card">
                        <div class="card-header bg-white text-dark">
                            <div class="row">
                                <div class="col-5">
                                    <h5> <?= $row_pesan['nm_barang'] ?> (<?= $row_pesan['nm_kategori'] ?>)</h5>
                                </div>
                                <div class="col-4">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-6">
                                                <input class="form-control" type="hidden" name="id_pesanan" value="<?= $row_pesan['id_pesanan'] ?>">
                                                <input class="form-control" type="number" name="jumlah" value="<?= $row_pesan['total_p'] ?>">
                                            </div>
                                            <?php
                                            if ($subtotal['harga_total'] == 0) {
                                            ?>
                                                <div class="col-1">
                                                    <button class="btn btn-primary" name="updt">edit</button>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-3">
                                    <h5><?= $hasil_rupiah = "Rp " . number_format($row_pesan['harga'] * $row_pesan['total_p'], 0, ',', '.') ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['bayar'])) {
                        $id_pesanan = $row_pesan['id_pesanan'];
                        @$id_order = $row_pesan['id_order'];
                        $harga_total = $subtotal['subtotal'] + $subtotal['harga_ongkir'];
                        $total_p = $row_pesan['total_p'];
                        $alamat = $_POST['alamat'];
                        $pembayaran = $_POST['pembayaran'];

                        mysqli_query($koneksi, "UPDATE pesanan SET status =2,total='$total_p' WHERE id_pesanan = '$id_pesanan'") or die(mysqli_error($koneksi));

                        mysqli_query($koneksi, "UPDATE `order` SET harga = '$harga_total',alamat = '$alamat',pembayaran = '$pembayaran' WHERE id_order = '$id_order'") or die(mysqli_error($koneksi));
                    ?>
                        <script>
                            window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";
                        </script>

                <?php
                    }
                }
                ?>
            </div>
            <hr>
            <div class="row">
                <div class="col-9">
                    <h5>Total Keseluruhan</h5>
                </div>
                <div class="col-3">
                    <h5><?= @$hasil_rupiah = "Rp " . number_format($subtotal_kes['totl'], 0, ',', '.') ?></h5>
                </div>
            </div>
            <?php
            if ($subtotal['ongkir'] == 1) {
            ?>
                <form method="post">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control col-md-12" name="id_ongkir" required>
                                <option value="">--Pilih Lokasi Alamat Anda!</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM ongkir WHERE NOT id_ongkir = 1");
                                while ($r_ongkir = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?= $r_ongkir['id_ongkir'] ?>"><?= $r_ongkir['kota'] ?>,<?= $hasil_rupiah = "Rp " . number_format($r_ongkir['harga'], 0, ',', '.') ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <select class="form-control col-md-12" name="id_kurir" required>
                                <option value="">-- Silahkan Pilih Kurir</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kurir");
                                while ($r_kurir = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?= $r_kurir['id'] ?>"><?= $r_kurir['kurir'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" name="ongkir">Pilih</button>
                        </div>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="col-9">
                        <h5>Ongkir Ke <?= @$subtotal['kota'] ?>
                            dengan Kurir <?= @$subtotal['kurir'] ?> (<?= @$hasil_rupiah = "Rp " . number_format($subtotal['harga_ongkir'], 0, ',', '.') ?>)</h5>
                    </div>
                    <div class="col-3">
                        <h5><?= @$hasil_rupiah = "Rp " . number_format($subtotal['subtotal'] + $subtotal['harga_ongkir'], 0, ',', '.') ?>
                        </h5>
                    </div>
                </div>
                <?php
                if ($subtotal['pembayaran'] == 0) {
                } else {
                ?>
                    <div class="row">
                        <div class="col-12">
                            <h5>Alamat : <?= $subtotal['alamat'] ?></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Pembayaran : <?php
                                                if ($subtotal['pembayaran'] == 1) {
                                                    echo "Transfer";
                                                } else if ($subtotal['pembayaran'] == 2) {
                                                    echo "COD";
                                                }
                                                ?>(<?php
                                                    if ($subtotal['pembayaran'] == 3) {
                                                        echo "Dibayar";
                                                    } else {
                                                        echo "Belum Bayar";
                                                    }
                                                    ?>)</h5>
                        </div>
                    </div>
                    <?php
                    if (isset($subtotal['foto_pembayaran'])) {
                    ?>
                        <img src="././file/<?= $subtotal['foto_pembayaran'] ?>" width="300" height="300" alt="">
                    <?php
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="">Bukti pembayaran</label>
                            <input type="file" name="foto_pembayaran" class="form-control">
                        </div>
                        <br>
                        <div>
                            <button type="submit" name="foto_pembayaran" class="btn btn-primary">kirim</button>
                        </div>
                    </form>
                <?php
                }
                ?>
            <?php
            }
            ?>
            <br>
            <div>
                <?php
                if ($subtotal['harga_total'] == 0) {
                    if ($subtotal['ongkir'] == 1) {
                    } else {

                ?>
                        <form method="post">
                            <div>
                                <label> Alamat</label>
                                <input class="form-control" name="alamat" required>
                            </div>
                            <div>
                                <label> Pembayaran</label>
                                <select class="form-control" name="pembayaran" required>
                                    <option value="">--Pilih pembayaran</option>
                                    <option value="1">Transfer</option>
                                    <option value="2">COD</option>
                                </select>
                            </div>
                            <br>
                            <button class="btn btn-primary col-md-12" type="submit" name="bayar">Bayar</button>
                        </form>
                    <?php
                    }
                } else {
                    if ($subtotal['pembayaran'] == 4) {
                        $queryKomplen = mysqli_query($koneksi, "SELECT * FROM `komplen` WHERE id_order = $order");
                        $rk = mysqli_fetch_assoc($queryKomplen);
                    ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" value="<?= date('Y-m-d') ?>" name="tanggal_komplen" class="form-control" required>
                            </div>
                            <div>
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" required name="deskripsi_komplen" id=""><?= @$rk['deskripsi'] ?></textarea>
                            </div>
                            <div>
                                <label for="">Foto / Video</label>
                                <input type="file" name="bukti" class="form-control">
                            </div>
                            <br>
                            <div>
                                <button type="submit" name="komplen" class="btn btn-primary">Komplen</button>
                            </div>
                        </form>
                        <a href="halaman/menu/cetak.php?id_order=<?= $order ?>" class="btn btn-success col-md-12">Cetak</a>
                <?php
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_POST['simpan1'])) {

            $id_order = $order;
            $tgl = date('Y-m-d');
            $jumlah = $_POST['jumlah'];
            $id_barang = $_POST['id_barang'];
            $harga = $_POST['harga'];
            $status = 1;
            mysqli_query($koneksi, "INSERT INTO pesanan VALUES(null,'$id_order','$id_barang','$tgl','$jumlah',0,'$harga','$status')") or die(mysqli_error($koneksi));
        ?>
            <script>
                window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";
            </script>

        <?php
        }

        if (isset($_POST['updt'])) {
            $jumlah = $_POST['jumlah'];
            $id_pesanan1 = $_POST['id_pesanan'];
            mysqli_query($koneksi, "UPDATE pesanan SET jumlah = '$jumlah' WHERE id_pesanan = '$id_pesanan1'") or die(mysqli_error($koneksi));
        ?>
            <script>
                window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";
            </script>

        <?php

        }

        if (isset($_POST['ongkir'])) {
            $id_ongkir = substr($_POST['id_ongkir'], 0, 4);
            $id_kurir = $_POST['id_kurir'];
            mysqli_query($koneksi, "UPDATE `order` SET id_ongkir = '$id_ongkir',id_kurir = '$id_kurir' WHERE id_order = '$order'") or die(mysqli_error($koneksi));
        ?>
            <script>
                window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";
            </script>

            <?php
        }

        if (isset($_POST['komplen'])) {
            $queryKomplen = mysqli_query($koneksi, "SELECT * FROM `komplen` WHERE id_order = $order");
            $rk = mysqli_fetch_assoc($queryKomplen);
            if (isset($rk)) {
                $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg', 'mp4', 'mkv');
                $nama = $_FILES['bukti']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran    = $_FILES['bukti']['size'];
                $file_tmp = $_FILES['bukti']['tmp_name'];
                $nama_c = date('hisdmy') . $nama;
                $tanggal_komplen = $_POST['tanggal_komplen'];
                $deskripsi_komplen = $_POST['deskripsi_komplen'];
                if (empty($nama)) {
                    mysqli_query($koneksi, "UPDATE komplen SET tanggal='$tanggal_komplen',deskripsi='$deskripsi_komplen' WHERE id_order ='$order'") or die(mysqli_error($koneksi));
            ?>
                    <script>
                        swal({
                            title: "Success!",
                            text: "Edit data berhasil",
                            type: "success"
                        }, setTimeout(function() {

                            window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";

                        }, 1000));
                    </script>
                    <?php

                } else {
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        if ($ukuran < 104407000) {
                            move_uploaded_file($file_tmp, 'file/' . $nama_c);
                            mysqli_query($koneksi, "UPDATE komplen SET tanggal='$tanggal_komplen',deskripsi='$deskripsi_komplen',bukti='$nama_c' WHERE id_order ='$order'") or die(mysqli_error($koneksi));
                    ?>
                            <script>
                                swal({
                                    title: "Success!",
                                    text: "Edit data berhasil",
                                    type: "success"
                                }, setTimeout(function() {

                                    window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";

                                }, 1000));
                            </script>
                        <?php
                        } else {
                            echo 'UKURAN FILE TERLALU BESAR';
                        }
                    } else {
                        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
                    }
                }
            } else {
                $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg', 'mp4', 'mkv');
                $nama = $_FILES['bukti']['name'];
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran    = $_FILES['bukti']['size'];
                $file_tmp = $_FILES['bukti']['tmp_name'];
                $nama_c = date('hisdmy') . $nama;
                $tanggal_komplen = $_POST['tanggal_komplen'];
                $deskripsi_komplen = $_POST['deskripsi_komplen'];
                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    if ($ukuran < 104407000) {
                        move_uploaded_file($file_tmp, 'file/' . $nama_c);

                        mysqli_query($koneksi, "INSERT INTO komplen VALUES(null,'$order','$tanggal_komplen','$deskripsi_komplen','$nama_c',0)");
                        ?>
                        <script>
                            swal({
                                title: "Success!",
                                text: "Tambah data berhasil",
                                type: "success"
                            }, setTimeout(function() {

                                window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";

                            }, 1000));
                        </script>
                    <?php
                    } else {
                        echo 'UKURAN FILE TERLALU BESAR';
                    }
                } else {
                    echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
                }
            }
        }
        if (isset($_POST['foto_pembayaran'])) {
            $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
            $nama = $_FILES['foto_pembayaran']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran    = $_FILES['foto_pembayaran']['size'];
            $file_tmp = $_FILES['foto_pembayaran']['tmp_name'];
            $nama_c = date('hisdmy') . $nama;
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 104407000) {
                    move_uploaded_file($file_tmp, 'file/' . $nama_c);
                    mysqli_query($koneksi, "UPDATE `order` SET foto='$nama_c' WHERE id_order ='$order'") or die(mysqli_error($koneksi));
                    ?>
                    <script>
                        swal({
                            title: "Success!",
                            text: "Edit data berhasil",
                            type: "success"
                        }, setTimeout(function() {

                            window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order ?>";

                        }, 1000));
                    </script>
        <?php
                } else {
                    echo 'UKURAN FILE TERLALU BESAR';
                }
            } else {
                echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            }
        }
        ?>