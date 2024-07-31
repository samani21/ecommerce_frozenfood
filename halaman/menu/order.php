<?php
include "././koneksi.php";
$tgl = date('Y-m-d');
$id = $_SESSION['id'];
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_user = '$id' ");
$row_p = mysqli_fetch_assoc($pelanggan);
$id_pel = $row_p['id_pelanggan'];
mysqli_query($koneksi, "INSERT INTO `order` VALUES(null,'$id_pel',1,'$tgl',0,null,0,null,null)") or die(mysqli_error($koneksi));

$query = mysqli_query($koneksi, "SELECT * FROM `order` ORDER BY id_order desc ");
$row = mysqli_fetch_assoc($query);
?>
<script>
  swal({
    title: "Notifikasi!",
    text: "Silahkan pilih produk!",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $row['id_order'] ?>";

  }, 1000));
</script>