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
    <h3 align="center">DATA BARANG MASUK</h3>
    <hr>
    <?php
    include "../../koneksi.php";
    @$id_k = substr($_GET['id_kategori'],0,4);
    @$kategori = $_GET['id_kategori'];
    if(empty($id_k)){
        $query = mysqli_query($koneksi,"SELECT barang.*,barang_masuk.*,kategori.*, barang_masuk.jumlah as jum, barang_masuk.harga as harga_bm FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori");
    }else{
        $query = mysqli_query($koneksi,"SELECT barang.*,barang_masuk.*,kategori.*, barang_masuk.jumlah as jum, barang_masuk.harga as harga_bm FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k'");
    }
?>
<table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama barang</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
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
                <td><?= $row['jum'] ?></td>
                <td><?= $hasil_rupiah = "Rp " . number_format($row['harga_bm'],0,',','.') ?></td>
            </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>