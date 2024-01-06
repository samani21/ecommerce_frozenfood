<?php
if(isset($_POST['simpan1'])){
    ?>
    <script>
                     swal({
         title: "Success!",
         text: "Tambah data berhasil",
         type: "success"
         }, setTimeout(function(){

         window.location.href = "http://localhost/bikafrozen/index.php?page=menu&id_order=<?= $order?>";

         }, 1000));
     </script>

    <?php
 }
?>