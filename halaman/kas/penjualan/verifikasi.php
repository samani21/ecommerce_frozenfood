<?php
include "././koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "UPDATE transaksi_harian SET acc=1 WHERE id_penjualan = '$id'");

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