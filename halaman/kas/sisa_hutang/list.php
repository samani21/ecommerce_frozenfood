<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT supplier.nm_supplier,hutang.deskripsi,hutang.tanggal,hutang.id_hutang,hutang.id_hutang, jumlah_hutang,SUM(piutang.jumlah), jumlah_hutang- SUM(CASE WHEN piutang.status = 'Sudah dibayar' THEN jumlah ELSE 0 END) as sisa_hutang FROM `hutang` left JOIN piutang ON piutang.id_hutang = hutang.id_hutang JOIN supplier ON supplier.id_supplier = hutang.id_supplier GROUP BY hutang.id_hutang");
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
                <th>Sisa Hutang</th>
                <th>Aksi</th </tr>
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
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['sisa_hutang'], 0, ',', '.') ?></td>
                    <td><a href="index.php?page=edit_hutang&id=<?= $row['id_hutang'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_hutang&id=<?= $row['id_hutang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>