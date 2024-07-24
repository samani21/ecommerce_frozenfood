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
    <h3 align="center">DATA BARANG RUSAK</h3>
    <hr>
    <?php
    include "../../koneksi.php";
    @$id_k = substr($_GET['id_kategori'], 0, 4);
    @$kategori = $_GET['id_kategori'];
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    if (empty($id_k)) {
        $query = mysqli_query($koneksi, "SELECT * FROM `kondisi_barang` JOIN barang ON barang.id_barang = kondisi_barang.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE tgl BETWEEN '$dari' AND '$sampai'");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM `kondisi_barang` JOIN barang ON barang.id_barang = kondisi_barang.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k' AND tgl BETWEEN '$dari' AND '$sampai'");
    }
    $query1 = mysqli_query($koneksi, "SELECT * FROM kategori");
    ?>
    <pre>
periode tanggal <?= $dari ?> sampai <?= $sampai ?>
</pre>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama barang</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Jumlah Rusak</th>
                <th>Jumlah Baik</th>
                <th>Keterangan</th>
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
                    <td><?= $row['nm_kategori'] ?></td>
                    <td><?= $row['tgl'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['jumlah_baik'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
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