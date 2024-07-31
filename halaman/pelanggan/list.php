<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM pelanggan JOIN user ON user.id = pelanggan.id_user");
?>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>TTL</th>
                <th>Alamat</th>
                <th>No HP</th>
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
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tempat'] ?>, <?= date('d-m-Y', strtotime($row['tgl'])) ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td><?= $row['no_hp'] ?></td>
                    <td>
                        <a href="index.php?page=edit_pelanggan&id=<?= $row['id_pelanggan'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_pelanggan&id=<?= $row['id_pelanggan'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                        <?php
                        if ($_SESSION['level'] == "Super Admin") {
                            if ($row['is_verified'] == 1) {
                        ?>
                                <a href="index.php?page=blokir_pelanggan&id=<?= $row['id_user'] ?>" class="btn btn-dark" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Blokir</a>
                            <?php
                            } else if ($row['is_verified'] == 2) {
                            ?>
                                <a href="index.php?page=unblok_pelanggan&id=<?= $row['id_user'] ?>" class="btn btn-secondary" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Buka Blokir</a>
                        <?php
                            }
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