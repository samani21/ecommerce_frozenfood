<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM kurir WHERE id = '$id'");
?>
<script>
  swal({
    title: "Success!",
    text: "Hapus data berhasil",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=kurir";

  }, 1000));
</script>