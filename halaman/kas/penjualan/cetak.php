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
    <h3 align="center">KAS PITANG</h3>
    <hr>
    <?php
    include "../../../koneksi.php";
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $query = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE tanggal BETWEEN '$dari' AND '$sampai'");
    ?>
    <pre>
periode tanggal <?= $dari ?> sampai <?= $sampai ?>
</pre>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?></td>
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