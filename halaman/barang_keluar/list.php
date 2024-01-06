<?php
    include "././koneksi.php";
    $query = mysqli_query($koneksi,"SELECT * FROM `pesanan` JOIN barang ON barang.id_barang = pesanan.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE status =2");
?>
<div>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                while($row = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nm_barang'] ?></td>
                            <td><?= $row['nm_kategori'] ?></td>
                            <td><?= $row['total'] ?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($row['harga'],0,',','.') ?></td>
                            <td><?= $hasil_rupiah = "Rp " . number_format($row['harga']*$row['total'],0,',','.') ?></td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>