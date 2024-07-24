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
            <td colspan="4">
                <p style="font-size: 20px;">BIKA FROZEN FOOD</p>
            </td>
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
    <h3 align="center">HISTORY PEMBELIAN</h3>
    <hr>
    <?php
    include "../../koneksi.php";
    $id_pel = $_GET['id_pel'];
    $level = $_GET['level'];
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    if ($level == "Admin") {
        $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl as tgl FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE `order`.tgl BETWEEN '$dari' AND '$sampai'");
    } else {
        $query = mysqli_query($koneksi, "SELECT `order`.*,pelanggan.*,ongkir.*, `order`.harga as hrg, `order`.tgl as tgl FROM `order` JOIN pelanggan ON pelanggan.id_pelanggan = `order`.`id_pelanggan` JOIN ongkir ON ongkir.id_ongkir = `order`.`id_ongkir` WHERE pelanggan.id_user = $id_pel AND `order`.tgl BETWEEN '$dari' AND '$sampai'");
    }
    $query_t = mysqli_query($koneksi, "SELECT SUM(harga) as harga FROM `order` WHERE `order`.tgl BETWEEN '$dari' AND '$sampai'");
    $row_t = mysqli_fetch_array($query_t)
    ?>
    <pre>
periode tanggal <?= $dari ?> sampai <?= $sampai ?>
</pre>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Alamat</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tgl'] ?></td>
                    <td><?= $row['kota'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['hrg'], 0, ',', '.') ?></td>
                </tr>
            <?php
            }
            ?>
            <?php
            if ($level == "Admin") {
            ?>
                <tr>
                    <td colspan="4">Total pendapatan </td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row_t['harga'], 0, ',', '.') ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <br><br><br>
    <pre>
                                        Banjarmasin <?= date('d-m-Y') ?>



                                        


                                                Admin
</pre>
    </div>
</body>

</html>