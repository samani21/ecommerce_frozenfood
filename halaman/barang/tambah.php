<?php
    include "././koneksi.php";
    $query = mysqli_query($koneksi,"SELECT * FROM kategori");
?>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Nama Barang</label>
            <input type="text" name="nm_barang" class="form-control" autocomplete="off" autofocus required>
        </div>
        <div>
            <label for="">Kategori</label>
            <select  name="id_kategori" class="form-control" id="" required >
                <option value="">-Pilih</option>
                <?php
                    while($row = mysqli_fetch_array($query)){
                        ?>
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
                    }
                ?>
            </select>
        </div>
        <div>
            <label for="">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div>
                <label for="">Harga</label>
                <input type="text" name="harga" class="form-control" id="rupiah" required >
            </div>
        <div>
            <label for="">Foto</label>
            <input type="file" name="foto" class="form-control" required>
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
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
		$nama = $_FILES['foto']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['foto']['size'];
		$file_tmp = $_FILES['foto']['tmp_name'];
        $nama_c = date('hisdmy').$nama;
        $harga = preg_replace('/[Rp. ]/','',$_POST['harga']);
        $nm_barang = $_POST['nm_barang'];
        $id_kategori = substr($_POST['id_kategori'],0,4);
        $jumlah = $_POST['jumlah'];
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){			
                move_uploaded_file($file_tmp, 'file/'.$nama_c);
                mysqli_query($koneksi,"INSERT INTO barang VALUES(null,'$id_kategori','$nm_barang','$jumlah','$nama_c','$harga')") or die(mysqli_error($koneksi));
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
            }else{
                echo 'UKURAN FILE TERLALU BESAR';
            }
        }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }
?>