<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT piutang.*,supplier.nm_supplier FROM `piutang` JOIN hutang ON hutang.id_hutang = piutang.id_hutang JOIN supplier ON supplier.id_supplier = hutang.id_supplier WHERE jumlah IS NOT NULL ORDER BY tanggal DESC");

// Initialize variables for handling the row number logic
$current_hutang = null;
$row_number = 0;
$no = 1;
?>
<div>
    <form action="halaman/kas/piutang/cetak.php" method="get">
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
    <a href="index.php?page=tambah_piutang" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Supplier</th>
                <th>NO Invoice</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Angsuran Ke</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                    <td><?= $row['nm_supplier'] ?></td>
                    <td><?= $row['no_invoice'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $row['angsuran'] ?></td>
                    <td><?= $hasil_rupiah = "Rp " . number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <?php
                        if (!$row['acc'] == 1) {
                        ?>
                            <a href="index.php?page=edit_piutang&id=<?= $row['id_piutang'] ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?page=hapus_piutang&id=<?= $row['id_piutang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                            <a href="index.php?page=verifikasi_piutang&id=<?= $row['id_piutang'] ?>" class="btn btn-success" onclick="return confirm('Apakah data sudah benar ?')">ACC</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>