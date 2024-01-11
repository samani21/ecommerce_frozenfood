<?php
    include "././koneksi.php";
    $id = $_GET['id_order'];
    $query = mysqli_query($koneksi,"DELETE FROM `order` WHERE id_order = '$id'");
?>
<script>
            swal({
  title: "Success!",
  text: "Hapus data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=history";

}, 1000));
        </script>