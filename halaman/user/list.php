<?php
include "././koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM user");
?>
<div>
    <a href="index.php?page=tambah_user" class="btn btn-primary">Tambah</a>
</div>
<div>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Username</th>
                <th>Email</th>
                <th>Name</th>
                <th>Level</th>
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
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['level'] ?></td>
                    <td><?php if ($row['is_verified'] == 1) {
                        ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php
                        } else if ($row['is_verified'] == 0) {
                        ?>
                            <span class="badge bg-warning">Belum Aktif</span>
                        <?php
                        } else if ($row['is_verified'] == 2) {
                        ?>
                            <span class="badge bg-dark">Blokir</span>
                        <?php
                        } ?>
                    </td>
                    <td>
                        <a href="index.php?page=edit_user&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="index.php?page=hapus_user&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
                        <?php
                        if ($row['is_verified'] == 1) {
                        ?>
                            <a href="index.php?page=blokir_pelanggan&id=<?= $row['id'] ?>" class="btn btn-dark" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Blokir</a>
                        <?php
                        } else if ($row['is_verified'] == 2) {
                        ?>
                            <a href="index.php?page=unblok_pelanggan&id=<?= $row['id'] ?>" class="btn btn-secondary" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Buka Blokir</a>
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