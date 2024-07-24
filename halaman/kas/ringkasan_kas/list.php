<?php
include "././koneksi.php";
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
GROUP BY 
    tanggal
ORDER BY 
    tanggal;");
?>

<div>
    <table id="example" class="table table-striped" style="width:100%">
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
</div>