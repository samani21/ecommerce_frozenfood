<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"DELETE FROM barang_masuk WHERE id_barang_masuk = '$id'");
?>
<script>
            swal({
  title: "Success!",
  text: "Hapus data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=barang_masuk";

}, 1000));
        </script>