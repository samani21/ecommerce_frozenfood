<?php
include "././koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM piutang WHERE id_piutang = '$id'");

mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_piutang = '$id'");
?>
<script>
  swal({
    title: "Success!",
    text: "Hapus data berhasil",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=piutang";

  }, 1000));
</script>