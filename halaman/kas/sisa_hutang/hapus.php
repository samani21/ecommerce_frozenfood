<?php
include "././koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM hutang WHERE id_hutang = $id");
while ($row = mysqli_fetch_array($query)) {
  $id_hutang = $row['id_hutang'];
  $queryPiutang = mysqli_query($koneksi, "SELECT * FROM piutang WHERE id_hutang = '$id_hutang'");
  while ($rowPiutang = mysqli_fetch_array($queryPiutang)) {
    $id_piutang = $rowPiutang['id_piutang'];
    mysqli_query($koneksi, "DELETE FROM piutang WHERE id_piutang = '$id_piutang'");
    mysqli_query($koneksi, "DELETE FROM transaksi_harian WHERE id_piutang = '$id_piutang'");
  }
}
mysqli_query($koneksi, "DELETE FROM hutang WHERE id_hutang = '$id'");
?>
<script>
  swal({
    title: "Success!",
    text: "Hapus data berhasil",
    type: "success"
  }, setTimeout(function() {

    window.location.href = "http://localhost/bikafrozen/index.php?page=sisa_hutang";

  }, 1000));
</script>