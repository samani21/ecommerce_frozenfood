<?php
include "././koneksi.php";
$pa = $_GET['page'];
@$id_k = substr($_GET['id_kategori'], 0, 4);
@$kategori = $_GET['id_kategori'];
@$dari = $_GET['dari'];
@$sampai = $_GET['sampai'];
if (empty($dari) && empty($sampai)) {
    if (empty($id_k)) {
        $query = mysqli_query($koneksi, "SELECT barang.*,barang_masuk.*,kategori.*, barang_masuk.jumlah as jum FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori ");
    } else {
        $query = mysqli_query($koneksi, "SELECT barang.*,barang_masuk.*,kategori.*, barang_masuk.jumlah as jum FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k' ");
    }
} else {
    if (empty($id_k)) {
        $query = mysqli_query($koneksi, "SELECT barang.*,barang_masuk.*,kategori.*, barang_masuk.jumlah as jum FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE tgl BETWEEN '$dari' AND '$sampai'");
    } else {
        $query = mysqli_query($koneksi, "SELECT barang.*,barang_masuk.*,kategori.*, barang_masuk.jumlah as jum FROM barang_masuk JOIN barang ON barang.id_barang = barang_masuk.id_barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k' AND tgl BETWEEN '$dari' AND '$sampai'");
    }
}
$query1 = mysqli_query($koneksi, "SELECT * FROM kategori");
?>
<div class="row">
    <div class="col-12">
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
                <div class="col-2">
                    <input type="date" class="form-control" value="<?= $dari ?>" name="dari">
                </div>
                <div class="col-2">
                    <input type="date" class="form-control" value="<?= $sampai ?>" name="sampai">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div>
    <br>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama barang</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
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
                    <td><?= $row['tgl'] ?></td>
                    <td><?= $row['jum'] ?></td>
                    <td>
                        <a href="index.php?page=edit_barang_masuk&id=<?= $row['id_barang_masuk'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_barang_masuk&id=<?= $row['id_barang_masuk'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>