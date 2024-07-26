<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM supplier ");
?>
<div>
    <form action="halaman/supplier/cetak.php" method="get">
        <div class="row">
            <div class="col-6">
                <input type="text" name="cari" class="form-control">
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
        </div>
    </form>
</div>
<br>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Telpon</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nm_supplier'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['kota'] ?></td>
                    <td><?= $row['telp'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>