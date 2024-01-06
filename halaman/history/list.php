<?php
    include "././koneksi.php";
    $id_pel = $_SESSION['id'];
    if($_SESSION['level'] == "Admin"){
        $query = mysqli_query($koneksi,"SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir`");
    }else{
        $query = mysqli_query($koneksi,"SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE pelanggan.id_user = $id_pel");
    }
?>
<div>
    <a href="index.php?page=tambah_kategori" class="btn btn-primary">Tambah</a>
</div>
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
                            <td><?= $row['tgl'] ?></td>
                            <td><?= $row['kota'] ?></td>
                            <td><?= $row['hrg'] ?></td>
                            <td>
                                <a href="index.php?page=menu&id_order=<?= $row['id_order']?>" class="btn btn-warning">Cek</a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>