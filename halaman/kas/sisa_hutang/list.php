<?php
include "././koneksi.php";
if (isset($_GET['filter'])) {
    if ($_GET['filter'] == "Lunas") {
        $query = mysqli_query($koneksi, "SELECT 
    supplier.nm_supplier,
    hutang.deskripsi,
    hutang.tanggal,
    hutang.id_hutang,
    jumlah_hutang,
    SUM(piutang.jumlah) AS total_piutang,
    jumlah_hutang - SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN piutang.jumlah ELSE 0 END) AS sisa_hutang
FROM 
    hutang
LEFT JOIN 
    piutang ON piutang.id_hutang = hutang.id_hutang
JOIN 
    supplier ON supplier.id_supplier = hutang.id_supplier
GROUP BY 
    hutang.id_hutang
HAVING 
    sisa_hutang = 0;
");
    } else {
        $query = mysqli_query($koneksi, "SELECT 
    supplier.nm_supplier,
    hutang.deskripsi,
    hutang.tanggal,
    hutang.id_hutang,
    jumlah_hutang,
    SUM(piutang.jumlah) AS total_piutang,
    jumlah_hutang - SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN piutang.jumlah ELSE 0 END) AS sisa_hutang
FROM 
    hutang
LEFT JOIN 
    piutang ON piutang.id_hutang = hutang.id_hutang
JOIN 
    supplier ON supplier.id_supplier = hutang.id_supplier
GROUP BY 
    hutang.id_hutang
HAVING 
    sisa_hutang > 0;
");
    }
} else {
    $query = mysqli_query($koneksi, "SELECT 
supplier.nm_supplier,
hutang.deskripsi,
hutang.tanggal,
hutang.id_hutang,
jumlah_hutang,
SUM(piutang.jumlah) AS total_piutang,
jumlah_hutang - SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN piutang.jumlah ELSE 0 END) AS sisa_hutang
FROM 
hutang
LEFT JOIN 
piutang ON piutang.id_hutang = hutang.id_hutang
JOIN 
supplier ON supplier.id_supplier = hutang.id_supplier
GROUP BY 
hutang.id_hutang
");
};
?>

<div>
    <form action="halaman/kas/sisa_hutang/cetak.php" method="get">
        <div class="row">
            <div class="col-5">
                <input type="date" name="dari" value="<?= date('Y-m-d') ?>" class="form-control" required>
            </div>
            <div class="col-5">
                <input type="date" name="sampai" value="<?= date('Y-m-d') ?>" class="form-control" required>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col-5">
            <form action="" method="get">
                <div class="row">
                    <div class="col-5">
                        <input type="hidden" name="page" value="sisa_hutang">
                        <select name="filter" id="" class="form-control">
                            <?php
                            if (isset($_GET['filter'])) {
                            ?>
                                <option value="<?= $_GET['filter'] ?>"><?= $_GET['filter'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="">--pilih</option>
                            <?php
                            }
                            ?>
                            <option value="Lunas">Lunas</option>
                            <option value="Belum Lunas">Belum Lunas</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form action="halaman/kas/sisa_hutang/cetak.php" method="get">
                <div class="row">
                    <div class="col-5">
                        <input type="hidden" name="page" value="sisa_hutang">
                        <select name="filter" id="" class="form-control">
                            <?php
                            if (isset($_GET['filter'])) {
                            ?>
                                <option value="<?= $_GET['filter'] ?>"><?= $_GET['filter'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="">--pilih</option>
                            <?php
                            }
                            ?>
                            <option value="Lunas">Lunas</option>
                            <option value="Belum Lunas">Belum Lunas</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div>
    <a href="index.php?page=tambah_hutang" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tanggal</th>
                <th>Nama Supplier</th>
                <th>Deskripsi</th>
                <th>Transaksi Awal</th>
                <th>Sisa Hutang</th>
                <th>Status</th>
                <th>Aksi</th>
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
                    <td><?= $row['nm_supplier'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah_hutang'], 0, ',', '.') ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['sisa_hutang'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        if ($row['sisa_hutang'] > 0) {
                        ?>
                            Belum Lunas
                        <?php
                        } else {
                        ?>
                            Lunas
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                        <a href="index.php?page=edit_hutang&id=<?= $row['id_hutang'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_hutang&id=<?= $row['id_hutang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                        <a href="halaman/kas/sisa_hutang/cetak_angsuran.php?id=<?= $row['id_hutang'] ?>" class="btn btn-success">Angsuran</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>