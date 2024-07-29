<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"UPDATE user SET is_verified =2 WHERE id = '$id'");
?>
<script>
            swal({
  title: "Success!",
  text: "Blokir data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=pelanggan";

}, 1000));
        </script>