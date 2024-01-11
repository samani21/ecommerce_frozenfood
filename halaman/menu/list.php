<?php
include "././koneksi.php";
$pa = $_GET['page'];
@$id_k = substr($_GET['id_kategori'],0,4);
@$kategori = $_GET['id_kategori'];
@$order = $_GET['id_order'];
$query1 = mysqli_query($koneksi,"SELECT * FROM kategori");
?>

<div class="row">
    <div class="col-9">
        <form action="" method="get">
            <div class="row">
                <input type="hidden" name="page" value="<?= $pa ?>" class="form-control" required>
                <input type="hidden" name="halaman" value="1" class="form-control" required>
                <input type="hidden" name="id_order" value="<?= $order?>" class="form-control" required>
                <div class="col-6">
                    <select name="id_kategori" class="form-control" id="">
                        <option value="">Semua</option>
                        <?php
                    while($row1 = mysqli_fetch_array($query1)){
                        ?>
                        <option value="<?php
                        if($row1['id_kategori'] < 10){
                            echo "000".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 100){
                            echo "00".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 1000){
                            echo "0".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 10000){
                            echo $row1['id_kategori'];
                        }
                        ?>, <?= $row1['nm_kategori']?>"><?php
                        if($row1['id_kategori'] < 10){
                            echo "000".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 100){
                            echo "00".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 1000){
                            echo "0".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 10000){
                            echo $row1['id_kategori'];
                        }
                        ?>, <?= $row1['nm_kategori']?></option>
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
                if(empty($order)){
                    if($_SESSION['level'] == "Admin"){

                    }else{
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
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

        $previous = $halaman - 1;
        $next = $halaman + 1;
        if(empty($id_k)){
            $data = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori");
        }else{
            $data = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k'");
        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        if(empty($id_k)){
            $query = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori limit $halaman_awal, $batas");
        }else{
            $query = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k' limit $halaman_awal, $batas");
        }
        $nomor = $halaman_awal+1;
            while($row = mysqli_fetch_array($query)){
                ?>
        <div class="card">
            <div class="card-header bg-info">
                <div class="row">
                    <div class="col-6">
                        <h4><?= $nomor++  ?>. <?= $row['nm_barang']?></h4>
                    </div>
                    <div class="col-3">
                        <h4><?= $row['nm_kategori']?></h4>
                    </div>
                    <div class="col-3">
                        <h4><?= $hasil_rupiah = "Rp " . number_format($row['harga'],0,',','.') ?></h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <td width="40%"><img src="././file/<?= $row['foto']?>" alt="" width="40%"></td>
                    <td width="30%">Stok <?= $row['jumlah']?></</td> <td width="30%">
                        <?php
                            if(empty($order)){

                            }else{
                                ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" name="jumlah" class="form-control" required>
                                    <input type="hidden" name="harga" value="<?= $row['harga']?>" class="form-control"
                                        required>
                                    <input type="hidden" name="id_barang" value="<?= $row['id_barang']?>"
                                        class="form-control" required>
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
                    <a class="page-link"
                        <?php if($halaman > 1){ echo "href='?page=menu&halaman=$previous&id_kategori=$kategori&id_order=$order'"; } ?>>Previous</a>
                </li>
                <?php 
				for($x=1;$x<=$total_halaman;$x++){
					?>
                <li class="page-item"><a class="page-link"
                        href="?page=menu&halaman=<?php echo $x ?>&id_kategori=<?= $kategori ?>&id_order=<?= $order ?>"><?php echo $x; ?></a>
                </li>
                <?php
				}
				?>
                <li class="page-item">
                    <a class="page-link"
                        <?php if($halaman < $total_halaman) { echo "href='?page=menu&halaman=$next&id_kategori=$kategori&id_order=$order'"; } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-6">
        <?php
            if(empty($order)){

            }else{
                ?>
        <div class="card">
            <div class="card-header bg-info">
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
                $pesan = mysqli_query($koneksi,"SELECT pesanan.jumlah as total_p ,pesanan.*,barang.*,kategori.* FROM pesanan JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE pesanan.id_order = '$order'");
                $total = mysqli_query($koneksi,"SELECT SUM(pesanan.jumlah*pesanan.harga) as subtotal, `order`.harga as harga_total,`order`.id_ongkir as ongkir, ongkir.harga as harga_ongkir,ongkir.kota as kota,`order`.alamat,`order`.pembayaran FROM `pesanan` JOIN `order` ON `order`.`id_order`= `pesanan`.`id_order` JOIN ongkir ON ongkir.id_ongkir = `order`.id_ongkir WHERE `order`.`id_order`= '$order'");
                $subtotal = mysqli_fetch_array($total);

                $total_kes = mysqli_query($koneksi,"SELECT SUM(jumlah*harga) as totl FROM `pesanan` WHERE id_order = '$order'");
                $subtotal_kes = mysqli_fetch_array($total_kes);
                while($row_pesan = mysqli_fetch_array($pesan)){
                ?>

            <div class="card">
                <div class="card-header bg-secondary">
                    <div class="row">
                        <div class="col-5">
                            <h5> <?= $row_pesan['nm_barang']?> (<?= $row_pesan['nm_kategori']?>)</h5>
                        </div>
                        <div class="col-4">
                            <form method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <input class="form-control" type="hidden" name="id_pesanan"
                                            value="<?= $row_pesan['id_pesanan']?>">
                                        <input class="form-control" type="number" name="jumlah"
                                            value="<?= $row_pesan['total_p']?>">
                                    </div>
                                    <?php
                                        if($subtotal['harga_total'] == 0 ){
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
                            <h5><?= $hasil_rupiah = "Rp " . number_format($row_pesan['harga']*$row_pesan['total_p'],0,',','.') ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_POST['bayar'])){
                                    $id_pesanan = $row_pesan['id_pesanan'];
                @$id_order =$row_pesan['id_order'];
                $harga_total = $subtotal['subtotal']+$subtotal['harga_ongkir'];
                $total_p = $row_pesan['total_p'];
                $alamat = $_POST['alamat'];
                $pembayaran = $_POST['pembayaran'];
                
                mysqli_query($koneksi,"UPDATE pesanan SET status =2,total='$total_p' WHERE id_pesanan = '$id_pesanan'") or die(mysqli_error($koneksi));
                
                mysqli_query($koneksi,"UPDATE `order` SET harga = '$harga_total',alamat = '$alamat',pembayaran = '$pembayaran' WHERE id_order = '$id_order'") or die(mysqli_error($koneksi));
               ?>
            <script>
                window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order?>";
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
                <h5><?= $hasil_rupiah = "Rp " . number_format($subtotal_kes['totl'],0,',','.') ?></h5>
            </div>
        </div>
        <?php
                if($subtotal['ongkir'] == 1){
                    ?>
        <form method="post">
            <div class="row">
                <div class="col-8">
                    <select class="form-control col-md-12" name="id_ongkir" required>
                        <option value="">--Pilih</option>
                        <?php
                $query = mysqli_query($koneksi,"SELECT * FROM ongkir WHERE NOT id_ongkir = 1");
                while($r_ongkir = mysqli_fetch_array($query)){
                    ?>
                        <option
                            value="<?php
                        if($r_ongkir['id_ongkir'] < 10){
                            echo "000".$r_ongkir['id_ongkir'];
                        }else if($r_ongkir['id_ongkir'] < 100){
                            echo "00".$r_ongkir['id_ongkir'];
                        }else if($r_ongkir['id_ongkir'] < 1000){
                            echo "0".$r_ongkir['id_ongkir'];
                        }else if($r_ongkir['id_ongkir'] < 10000){
                            echo $r_ongkir['id_ongkir'];
                        }
                        ?>, <?= $r_ongkir['kota']?>, <?= $hasil_rupiah = "Rp " . number_format($r_ongkir['harga'],0,',','.') ?>"><?php
                        if($r_ongkir['id_ongkir'] < 10){
                            echo "000".$r_ongkir['id_ongkir'];
                        }else if($r_ongkir['id_ongkir'] < 100){
                            echo "00".$r_ongkir['id_ongkir'];
                        }else if($r_ongkir['id_ongkir'] < 1000){
                            echo "0".$r_ongkir['id_ongkir'];
                        }else if($r_ongkir['id_ongkir'] < 10000){
                            echo $r_ongkir['id_ongkir'];
                        }
                        ?>, <?= $r_ongkir['kota']?>,
                            <?= $hasil_rupiah = "Rp " . number_format($r_ongkir['harga'],0,',','.') ?></option>
                        <?php
                }
                ?>
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-primary" name="ongkir">Pilih</button>
                </div>
            </div>
        </form>
        <?php
                }else{
                    ?>
        <div class="row">
            <div class="col-9">
                <h5>Ongkir <?= $subtotal['kota']?>
                    (<?= $hasil_rupiah = "Rp " . number_format($subtotal['harga_ongkir'],0,',','.') ?>)</h5>
            </div>
            <div class="col-3">
                <h5><?= $hasil_rupiah = "Rp " . number_format($subtotal['subtotal']+$subtotal['harga_ongkir'],0,',','.') ?>
                </h5>
            </div>
        </div>
       <?php
            if($subtotal['pembayaran'] == 0){
                
            }else{
                ?>
     <div class="row">
            <div class="col-12">
                <h5>Alamat : <?= $subtotal['alamat']?></h5>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h5>Pembayaran : <?php
                    if($subtotal['pembayaran'] == 1){
                        echo "Transfer";
                    }else if($subtotal['pembayaran'] == 2){
                        echo "COD";
                    }
                ?>(<?php
                    if($subtotal['pembayaran'] == 3){
                        echo "Dibayar";
                    }else{
                        echo "Belum Bayar";
                    }
                ?>)</h5>
            </div>
        </div>
                <?php
            }
       ?>
        <?php
                }
            ?>
        <br>
        <div>
            <?php
                if($subtotal['harga_total'] == 0){
                   if($subtotal['ongkir'] == 1){
                    
                   }else{

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
                }else{
                    if($subtotal['pembayaran'] == 3){
                        ?>
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
if(isset($_POST['simpan1'])){
                                    
    $id_order = $order;
    $tgl = date('Y-m-d');
    $jumlah = $_POST['jumlah'];
    $id_barang = $_POST['id_barang'];
    $harga = $_POST['harga'];
    $status = 1;
    mysqli_query($koneksi,"INSERT INTO pesanan VALUES(null,'$id_order','$id_barang','$tgl','$jumlah',0,'$harga','$status')") or die(mysqli_error($koneksi));
   ?>
        <script>
            window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order?>";
        </script>

        <?php
}

if(isset($_POST['updt'])){
    $jumlah = $_POST['jumlah'];
    $id_pesanan1 = $_POST['id_pesanan'];
mysqli_query($koneksi,"UPDATE pesanan SET jumlah = '$jumlah' WHERE id_pesanan = '$id_pesanan1'") or die(mysqli_error($koneksi));
?>
        <script>
            window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order?>";
        </script>

        <?php

}

if(isset($_POST['ongkir'])){
$id_ongkir = substr($_POST['id_ongkir'],0,4);

mysqli_query($koneksi,"UPDATE `order` SET id_ongkir = '$id_ongkir' WHERE id_order = '$order'") or die(mysqli_error($koneksi));
?>
        <script>
            window.location = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order?>";
        </script>

        <?php
}
?>