<?php
include "././koneksi.php";
$id_order = $_GET['id_order'];
mysqli_query($koneksi, "UPDATE `order` SET pembayaran = 4 WHERE id_order = '$id_order'") or die(mysqli_error($koneksi));
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