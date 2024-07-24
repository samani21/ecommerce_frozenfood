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
    <h3 align="center">RINGKASAN KAS</h3>
    <hr>
    <?php
    include "../../../koneksi.php";
    $dari = $_GET['dari'];
    $sampai = $_GET['sampai'];
    $query = mysqli_query($koneksi, "SELECT 
    tanggal,
    MIN(CASE WHEN rn_awal = 1 THEN saldo_awal END) AS saldo_awal,
    SUM(pemasukkan) AS pemasukkan,
    SUM(pengeluaran) AS pengeluaran,
    MAX(CASE WHEN rn_akhir = 1 THEN saldo_akhir END) AS saldo_akhir
FROM (
    SELECT
        tanggal,
        deskripsi,
        jumlah,
        saldo_awal,
        saldo_akhir,
        pemasukkan,
        pengeluaran,
        ROW_NUMBER() OVER (PARTITION BY tanggal ORDER BY id_transaksi) AS rn_awal,
        ROW_NUMBER() OVER (PARTITION BY tanggal ORDER BY id_transaksi DESC) AS rn_akhir
    FROM 
        transaksi_harian
) AS subquery
WHERE tanggal BETWEEN '$dari' AND '$sampai'
GROUP BY 
    tanggal
ORDER BY 
    tanggal");
    ?>
    <pre>
periode tanggal <?= $dari ?> sampai <?= $sampai ?>
</pre>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal</th>
                <th>Saldo Awal</th>
                <th>Saldo Akhir</th>
                <th>Pemasukkan</th>
                <th>Pengeluaran</th>
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
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['saldo_awal'], 0, ',', '.') ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['saldo_akhir'], 0, ',', '.') ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['pemasukkan'], 0, ',', '.') ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['pengeluaran'], 0, ',', '.') ?></td>
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