<?php
include "././koneksi.php";
$pa = $_GET['page'];
@$id_k = substr($_GET['id_kategori'], 0, 4);
@$kategori = $_GET['id_kategori'];
if (empty($id_k)) {
    $query = mysqli_query($koneksi, "SELECT barang.nm_barang,barang.id_barang,kategori.nm_kategori,barang.merek,barang.jumlah,jual_beli.jual,jual_beli.beli FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori left JOIN jual_beli ON jual_beli.id_barang = barang.id_barang");
} else {
    $query = mysqli_query($koneksi, "SELECT barang.nm_barang,barang.id_barang,kategori.nm_kategori,barang.merek,barang.jumlah,jual_beli.jual,jual_beli.beli FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori left JOIN jual_beli ON jual_beli.id_barang = barang.id_barang WHERE barang.id_kategori = '$id_k'");
}
$query1 = mysqli_query($koneksi, "SELECT * FROM kategori");
?>
<div class="row">
    <div class="col-3">
        <a href="index.php?page=tambah_barang" class="btn btn-primary">Tambah</a>
    </div>
    <div class="col-9">
        <form action="" method="get">
            <div class="row">
                <input type="hidden" name="page" value="<?= $pa ?>" class="form-control" required>
                <div class="col-6">
                    <select name="id_kategori" class="form-control" id="">
                        <option value="">Semua</option>
                        <?php
                        while ($row1 = mysqli_fetch_array($query1)) {
                        ?>
                            <option value="<?php
                                            if ($row1['id_kategori'] < 10) {
                                                echo "000" . $row1['id_kategori'];
                                            } else if ($row1['id_kategori'] < 100) {
                                                echo "00" . $row1['id_kategori'];
                                            } else if ($row1['id_kategori'] < 1000) {
                                                echo "0" . $row1['id_kategori'];
                                            } else if ($row1['id_kategori'] < 10000) {
                                                echo $row1['id_kategori'];
                                            }
                                            ?>, <?= $row1['nm_kategori'] ?>"><?php
                                                                                if ($row1['id_kategori'] < 10) {
                                                                                    echo "000" . $row1['id_kategori'];
                                                                                } else if ($row1['id_kategori'] < 100) {
                                                                                    echo "00" . $row1['id_kategori'];
                                                                                } else if ($row1['id_kategori'] < 1000) {
                                                                                    echo "0" . $row1['id_kategori'];
                                                                                } else if ($row1['id_kategori'] < 10000) {
                                                                                    echo $row1['id_kategori'];
                                                                                }
                                                                                ?>, <?= $row1['nm_kategori'] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama barang</th>
                <th>Kategori</th>
                <th>Merek</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
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
                    <td><?= $row['nm_barang'] ?></td>
                    <td><?= $row['nm_kategori'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= @$hasil_rupiah = "Rp " . number_format($row['beli'], 0, ',', '.') ?></td>
                    <td><?= @$hasil_rupiah = "Rp " . number_format($row['jual'], 0, ',', '.') ?></td>
                    <td>
                        <a href="index.php?page=tambah_barang_masuk&id=<?= $row['id_barang'] ?>" class="btn btn-success">Restok</a>
                        <a href="index.php?page=tambah_barang_rusak&id=<?= $row['id_barang'] ?>" class="btn btn-danger">Rusak</a>
                        <a href="index.php?page=edit_barang&id=<?= $row['id_barang'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_barang&id=<?= $row['id_barang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>