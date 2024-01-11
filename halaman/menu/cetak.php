<?php
    include "../../koneksi.php";
    $id_order = $_GET['id_order'];
    $query = mysqli_query($koneksi,"SELECT barang.nm_barang,kategori.nm_kategori,pesanan.jumlah,pesanan.jumlah*pesanan.harga as harga FROM `pesanan` JOIN `order` ON `order`.`id_order` = pesanan.id_order JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE pesanan.id_order = '$id_order'");
    $total_query = mysqli_query($koneksi,"SELECT `order`.`harga`-ongkir.harga as subtotal, ongkir.harga as ongkir, `order`.`harga`,`order`.alamat,`order`.pembayaran as total,`order`.`tgl` FROM `order` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE id_order = '$id_order'");
    $row_totl = mysqli_fetch_array($total_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="window.print()">
    
    <table>
        <tr>
            <td colspan="4"><p style="font-size: 20px;">BIKA FROZEN FOOD</p></td>
        </tr>
        <tr>
            <td width="6%">
                <img src="../../file/ig.png" alt="" width="50%">
            </td>
            <td>
                <h5>bika.frozenfoodbtk</h5>
            </td>
            <td width="6%">
                <img src="../../file/icon-wa.png" alt="" width="50%">
            </td>
            <td>
                <h5>0821 4074 3958</h5>
            </td>
        </tr>
    </table>
    <hr>
    <h3 align="center">NOTA PEMBELIAN</h3>
    <hr>
<h4><?= date('d-m-Y', strtotime($row_totl['tgl']))?></h4>
<h5><?= $row_totl['alamat']?></h5>
<table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Qty</th>
                <th>Nama barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?= $row['jumlah'] ?></td>
                            <td><?= $row['nm_barang'] ?>,(<?= $row['nm_kategori'] ?>)</td>
                            <td><?= $row['nm_kategori'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($row['harga'],0,',','.') ?></td>
                        </tr>
                    <?php
                }
            ?>
            <tr>
                <td colspan="4" align="right">Total Harga</td>
                <td><?= $hasil_rupiah = "Rp " . number_format($row_totl['subtotal'],0,',','.') ?></td>
            </tr>
            <tr>
                <td colspan="4" align="right">Ongkir</td>
                <td><?= $hasil_rupiah = "Rp " . number_format($row_totl['ongkir'],0,',','.') ?></td>
            </tr>
            <tr>
                <td colspan="4" align="right">Total Semua</td>
                <td><?= $hasil_rupiah = "Rp " . number_format($row_totl['total'],0,',','.') ?></td>
            </tr>
        </tbody>
    </table>
    <br><br><br>
<pre>
                                        Banjarmasin <?= date('d-m-Y')?>



                                        


                                                Admin
</pre>
</div>
</body>
</html>