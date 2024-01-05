<?php
    include "././koneksi.php";
    $tgl = date('Y-m-d');
    mysqli_query($koneksi,"INSERT INTO `order` VALUES(null,'$tgl')") or die(mysqli_error($koneksi));

    $query = mysqli_query($koneksi,"SELECT * FROM `order` ORDER BY id_order desc ");
    $row = mysqli_fetch_assoc($query);
?>
<script>
            swal({
  title: "Success!",
  text: "Hapus data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $row['id_order'] ?>";

}, 1000));
        </script>