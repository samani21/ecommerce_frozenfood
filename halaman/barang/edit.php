<?php
    include "././koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE id_barang = '$id'");
    $row = mysqli_fetch_assoc($query);

    $query1 = mysqli_query($koneksi,"SELECT * FROM kategori");
?>
<div>
    <form action="" method="post">
    <div>
            <label for="">Nama Barang</label>
            <input type="text" name="nm_barang" class="form-control" value="<?= $row['nm_barang'] ?>" autocomplete="off" autofocus>
        </div>
        <div>
            <label for="">Kategori</label>
            <select  name="id_kategori" class="form-control" id="" required >
                <option value="<?php
                        if($row['id_kategori'] < 10){
                            echo "000".$row['id_kategori'];
                        }else if($row['id_kategori'] < 100){
                            echo "00".$row['id_kategori'];
                        }else if($row['id_kategori'] < 1000){
                            echo "0".$row['id_kategori'];
                        }else if($row['id_kategori'] < 10000){
                            echo $row['id_kategori'];
                        }
                        ?>, <?= $row['nm_kategori']?>"><?php
                        if($row['id_kategori'] < 10){
                            echo "000".$row['id_kategori'];
                        }else if($row['id_kategori'] < 100){
                            echo "00".$row['id_kategori'];
                        }else if($row['id_kategori'] < 1000){
                            echo "0".$row['id_kategori'];
                        }else if($row['id_kategori'] < 10000){
                            echo $row['id_kategori'];
                        }
                        ?>, <?= $row['nm_kategori']?></option>
                <?php
                    while($row1 = mysqli_fetch_array($query1)){
                        ?>
                        <option value="<?php
                        if($row1['id_kategori'] < 10){
                            echo "000".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 100){
                            echo "00".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 1000){
                            echo "0".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 10000){
                            echo $row1['id_kategori'];
                        }
                        ?>, <?= $row1['nm_kategori']?>"><?php
                        if($row1['id_kategori'] < 10){
                            echo "000".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 100){
                            echo "00".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 1000){
                            echo "0".$row1['id_kategori'];
                        }else if($row1['id_kategori'] < 10000){
                            echo $row1['id_kategori'];
                        }
                        ?>, <?= $row1['nm_kategori']?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="text" name="jumlah" value="<?= $row['jumlah']?>" class="form-control" required>
        </div>
        <br>
        <div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <button type="reset" name="simpan" class="btn btn-danger">Reset</button>
        </div>
    </form>
</div>

<?php
    include "././koneksi.php";
    if(isset($_POST['simpan'])){
        $nm_barang = $_POST['nm_barang'];
        $id_kategori = substr($_POST['id_kategori'],0,4);
        $jumlah = $_POST['jumlah'];

        mysqli_query($koneksi,"UPDATE barang SET id_kategori='$id_kategori',nm_barang='$nm_barang',jumlah='$jumlah' WHERE id_barang ='$id'") or die(mysqli_error($koneksi));
        ?>
        <script>
            swal({
  title: "Success!",
  text: "Tambah data berhasil",
  type: "success"
}, setTimeout(function(){

window.location.href = "http://localhost/bikafrozen/index.php?page=barang";

}, 1000));
        </script>
        <?php   
    }
?>