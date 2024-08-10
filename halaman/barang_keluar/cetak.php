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
    <h3 align="center">DATA BARANG KELUAR</h3>
    <hr>
    <?php
    include "../../koneksi.php";
    @$id_k = substr($_GET['id_kategori'], 0, 4);
    @$kategori = $_GET['id_kategori'];
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    if (empty($id_k)) {
        $query = mysqli_query($koneksi, "SELECT pesanan.*, barang.*, kategori.* FROM pesanan JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE pesanan.tgl BETWEEN '$dari' AND '$sampai'");
    } else {
        $query = mysqli_query($koneksi, "SELECT pesanan.*, barang.*, kategori.* FROM pesanan JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k' AND pesanan.tgl BETWEEN '$dari' AND '$sampai'");
    }

    $query_to = mysqli_query($koneksi, "SELECT SUM(total*harga) as total FROM pesanan WHERE tgl BETWEEN '$dari' AND '$sampai'");
    $row_to = mysqli_fetch_array($query_to);
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
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nm_barang'] ?></td>
                    <td><?= $row['tgl'] ?></td>
                    <td><?= $row['nm_kategori'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= @$hasil_rupiah = "Rp " . number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><?= @$hasil_rupiah = "Rp " . number_format($row['harga'] * $row['total'], 0, ',', '.') ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="6" align="right">Total</td>
                <td colspan="6" align="left"><?= @$hasil_rupiah = "Rp " . number_format($row_to['total'], 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
    <br><br><br>
    <pre>
                                        Buntok <?= date('d-m-Y') ?>



                                        


                                                Admin
</pre>
    </div>
</body>

</html>