<?php
include "././koneksi.php";
$id = $_GET['id'];
mysqli_query($koneksi, "UPDATE kewajiban SET acc=1 WHERE id_kewajiban = '$id'");

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