<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"DELETE FROM supplier WHERE id_supplier = '$id'");
?>
<script>
            swal({
  title: "Success!",
  text: "Hapus data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=supplier";

}, 1000));
        </script>