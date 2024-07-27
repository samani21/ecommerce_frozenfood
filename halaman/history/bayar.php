<?php
include "././koneksi.php";
require "././mail_kirim_barang.php";
$id_order = $_GET['id_order'];
$email = $_GET['email'];
mysqli_query($koneksi, "UPDATE `order` SET pembayaran = 3 WHERE id_order = '$id_order'") or die(mysqli_error($koneksi));
sendPengirmanBarang($email, $id_order)
?>
<script>
  swal({
    title: "Success!",
    text: "Pembayaran berhasil diverifikasi",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=history";

  }, 1000));
</script>