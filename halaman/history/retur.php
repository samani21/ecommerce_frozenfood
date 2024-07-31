<?php
include "././koneksi.php";
$id_order = $_GET['id_order'];
$status = $_GET['status'];
mysqli_query($koneksi, "UPDATE `komplen` SET status_retur = $status WHERE id_order = '$id_order'") or die(mysqli_error($koneksi));
if ($_GET['status'] == 1) {
    mysqli_query($koneksi, "UPDATE `order` SET pembayaran=6 WHERE id_order ='$id_order'") or die(mysqli_error($koneksi));
} else {
    mysqli_query($koneksi, "UPDATE `order` SET pembayaran=7 WHERE id_order ='$id_order'") or die(mysqli_error($koneksi));
}

?>
<script>
    swal({
        title: "Success!",
        text: "Pembayaran berhasil diverifikasi",
        type: "success"
    }, setTimeout(function() {

        window.location.href = "http://localhost/bikafrozen/index.php?page=komplen";

    }, 1000));
</script>