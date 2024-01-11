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
    <h3 align="center">LAPORAN LABA BERSIH</h3>
    <hr>
    <?php
    include "../../koneksi.php";
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $query_p= mysqli_query($koneksi,"SELECT SUM(harga) as harga FROM `order` WHERE tgl BETWEEN '$dari' AND '$sampai' ");
    $row_p = mysqli_fetch_array($query_p);

    $query_h= mysqli_query($koneksi,"SELECT SUM((harga - ((barang.harga/100)*10)) * barang_masuk.jumlah) as keluar FROM `barang_masuk` JOIN barang ON barang.id_barang = barang_masuk.id_barang WHERE tgl BETWEEN '$dari' AND '$sampai' ");
    $row_h = mysqli_fetch_array($query_h);

?>
<table  width="100%">
    <tr>
        <td>Pendapatan</td>
        <td align="left"><?= $hasil_rupiah = "Rp " . number_format($row_p['harga'],0,',','.') ?></td>
    </tr>
    <tr>
        <td>Pengeluaran</td>
        <td align="left"><?= $hasil_rupiah = "Rp " . number_format($row_h['keluar'],0,',','.') ?></td>
    </tr>
    <tr>
        <td>Total laba bersih</td>
        <td align="left"><?= $hasil_rupiah = "Rp " . number_format($row_p['harga']-$row_h['keluar'],0,',','.') ?></td>
    </tr>
</table>
<br><br><br>
<pre>
                                        Banjarmasin <?= date('d-m-Y')?>






                                                Admin
</pre>
</div>
</body>
</html>