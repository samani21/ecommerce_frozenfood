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
    <h3 align="center">KAS PIUTANG</h3>
    <hr>
    <?php
    include "../../../koneksi.php";
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $query = mysqli_query($koneksi, "SELECT supplier.nm_supplier,piutang.* FROM `piutang`  
        join hutang ON hutang.id_hutang = piutang.id_hutang 
        JOIN supplier ON supplier.id_supplier = hutang.id_supplier 
        WHERE jumlah IS NOT NULL AND piutang.tanggal BETWEEN '$dari' AND '$sampai' ORDER BY piutang.tanggal DESC ");
    $current_hutang = null;
    $row_number = 0;
    ?>
    <pre>
periode tanggal <?= $dari ?> sampai <?= $sampai ?>
</pre>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>NO Invoice</th>
                <th>Supplier</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
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
                    <td><?= $row['nm_supplier'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $row['angsuran'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
            <?php
            }
            ?>
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