<?php
    include "././koneksi.php";
    $id_pel = $_SESSION['id'];
    if($_SESSION['level'] == "Admin"){
        $query = mysqli_query($koneksi,"SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl AS tgl_order FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir`");
    }else{
        $query = mysqli_query($koneksi,"SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl AS tgl_order FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE pelanggan.id_user = $id_pel");
    }
?>
<div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Ongkir</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($row = mysqli_fetch_array($query)){
                    ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['tgl_order'] ?></td>
                <td><?= $row['kota'] ?></td>
                <td><?= $hasil_rupiah = "Rp " . number_format($row['hrg'],0,',','.') ?></td>
                <td>
                    <a href="index.php?page=menu&id_order=<?= $row['id_order']?>" class="btn btn-warning">Cek</a>
                    
                    <?php
                                   if($_SESSION['level'] == "Admin"){
                                    if($row['pembayaran'] == 3){

                                    }else{
                                        ?>
                    <a href="index.php?page=bayar&id_order=<?= $row['id_order']?>" class="btn btn-success">Dibayar</a>
                    <a href="index.php?page=hapus_history&id_order=<?= $row['id_order']?>" class="btn btn-danger">Hapus</a>
                    <?php
                                    }
                                   }
                               ?>

                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>