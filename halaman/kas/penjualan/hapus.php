<?php
include "././koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan = '$id'");

mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_penjualan = '$id'");
?>
<script>
  swal({
    title: "Success!",
    text: "Hapus data berhasil",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=penjualan";

  }, 1000));
</script>