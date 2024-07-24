<?php
include "././koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM kewajiban WHERE id_kewajiban = '$id'");

mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_kewajiban = '$id'");
?>
<script>
  swal({
    title: "Success!",
    text: "Hapus data berhasil",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=kewajiban";

  }, 1000));
</script>