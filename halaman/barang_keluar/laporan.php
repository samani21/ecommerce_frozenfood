<?php
    include "././koneksi.php";
    $pa = $_GET['page'];
    @$id_k = substr($_GET['id_kategori'],0,4);
    @$kategori = $_GET['id_kategori'];
    if(empty($id_k)){
        $query = mysqli_query($koneksi,"SELECT pesanan.*, barang.*, kategori.* FROM pesanan JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori");
    }else{
        $query = mysqli_query($koneksi,"SELECT pesanan.*, barang.*, kategori.* FROM pesanan JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k'");
    }$query1 = mysqli_query($koneksi,"SELECT * FROM kategori");
?>
<div>
<div class="col-9">
<form action="halaman/barang_keluar/cetak.php" method="get">
            <div class="row">
                <input type="hidden" name="page" value="<?= $pa ?>" class="form-control" required>
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
                <div class="col-3">
                    <input type="date" class="form-control" name="dari" required>
                </div>
                <div class="col-3">
                    <input type="date" class="form-control" name="sampai" required>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">cetak</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama barang</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($row = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nm_barang'] ?></td>
                            <td><?= $row['tgl'] ?></td>
                            <td><?= $row['nm_kategori'] ?></td>
                            <td><?= $row['total'] ?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($row['harga'],0,',','.') ?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($row['harga']*$row['total'],0,',','.') ?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>