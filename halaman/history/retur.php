<?php
include "././koneksi.php";
$id_order = $_GET['id_order'];
$status = $_GET['status'];
mysqli_query($koneksi, "UPDATE `komplen` SET status_retur = $status WHERE id_order = '$id_order'") or die(mysqli_error($koneksi));
?>
<script>
    swal({
        title: "Success!",
        text: "Pembayaran berhasil diverifikasi",
        type: "success"
    }, setTimeout(function() {

        window.location.href = "http://localhost/bikafrozen/index.php?page=history";

    }, 1000));
</script>