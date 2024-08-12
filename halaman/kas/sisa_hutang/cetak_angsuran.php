<?php
include "../../../koneksi.php";
$id = $_GET['id'];

$queryHutang = mysqli_query($koneksi, "SELECT 
supplier.nm_supplier,
hutang.deskripsi,
hutang.tanggal,
hutang.id_hutang,
jumlah_hutang,
SUM(piutang.jumlah) AS total_piutang,
jumlah_hutang - SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN piutang.jumlah ELSE 0 END) AS sisa_hutang,
SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN piutang.jumlah ELSE 0 END) as dibayar
FROM 
hutang
LEFT JOIN 
piutang ON piutang.id_hutang = hutang.id_hutang
JOIN 
supplier ON supplier.id_supplier = hutang.id_supplier
WHERE hutang.id_hutang = $id
GROUP BY 
hutang.id_hutang
");
$rowHutang = mysqli_fetch_assoc($queryHutang);
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
    <h3 align="center">Angsuran</h3>
    <table>
        <tr>
            <th>Supplier</th>
            <th>:</th>
            <td><?= $rowHutang['nm_supplier'] ?></td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <th>:</th>
            <td><?= $rowHutang['deskripsi'] ?></td>
        </tr>
        <tr>
            <th>Transaksi</th>
            <th>:</th>
            <td><?= "Rp " . number_format($rowHutang['jumlah_hutang'], 0, ',', '.') ?></td>
        </tr>
    </table>
    <hr>
    <?php

    $query = mysqli_query($koneksi, "SELECT supplier.nm_supplier,piutang.* FROM `piutang`  
    join hutang ON hutang.id_hutang = piutang.id_hutang 
    JOIN supplier ON supplier.id_supplier = hutang.id_supplier 
    WHERE jumlah IS NOT NULL AND piutang.id_hutang = $id  ORDER BY piutang.tanggal DESC ");
    $current_hutang = null;
    $row_number = 0;
    ?>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>NO Invoice</th>
                <th>Tanggal</th>
                <th>Angsuran Ke</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
                if ($current_hutang === $row['id_hutang']) {
                    $row_number++;
                } else {
                    $row_number = 1;
                    $current_hutang = $row['id_hutang'];
                }

                $row['angsuran'] = $row_number;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['no_invoice'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['angsuran'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="3" align="right">Sisa Hutang</td>
                <td><?= "Rp " . number_format($rowHutang['sisa_hutang'], 0, ',', '.') ?></td>
                <td><?= "Rp " . number_format($rowHutang['dibayar'], 0, ',', '.') ?></td>
                <td>
                    <?php
                    if ($rowHutang['sisa_hutang'] == 0) {
                        echo "Lunas";
                    } else {
                        echo "Belum Lunas";
                    }
                    ?>
                </td>
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