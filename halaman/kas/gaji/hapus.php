<?php
include "././koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM gaji WHERE id_gaji = '$id'");

mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_gaji = '$id'");
?>
<script>
  swal({
    title: "Success!",
    text: "Hapus data berhasil",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=gaji";

  }, 1000));
</script>