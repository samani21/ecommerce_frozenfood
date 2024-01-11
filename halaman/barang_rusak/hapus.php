<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"DELETE FROM kondisi_barang WHERE id_kondisi = '$id'");
?>
<script>
            swal({
  title: "Success!",
  text: "Hapus data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=barang_rusak";

}, 1000));
        </script>