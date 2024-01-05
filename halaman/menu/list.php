<?php
include "././koneksi.php";
$pa = $_GET['page'];
@$id_k = substr($_GET['id_kategori'],0,4);
@$kategori = $_GET['id_kategori'];
$query1 = mysqli_query($koneksi,"SELECT * FROM kategori");
?>

<div class="row">
    <div class="col-9">
        <form action="" method="get">
            <div class="row">
                <input type="hidden" name="page" value="<?= $pa ?>" class="form-control" required>
                <input type="hidden" name="halaman" value="1" class="form-control" required>
                <div class="col-6">
                    <select name="id_kategori" class="form-control" id="">
                        <option value="">Semua</option>
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
                <div class="col-6">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-2">
        <div align="right">
        <a href="index.php?page=order" class="btn btn-warning">Order</a>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-6">
        <?php
        $batas = 5;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

        $previous = $halaman - 1;
        $next = $halaman + 1;
        if(empty($id_k)){
            $data = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori");
        }else{
            $data = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k'");
        }
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        if(empty($id_k)){
            $query = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori limit $halaman_awal, $batas");
        }else{
            $query = mysqli_query($koneksi,"SELECT * FROM barang JOIN kategori ON kategori.id_kategori = barang.id_kategori WHERE barang.id_kategori = '$id_k' limit $halaman_awal, $batas");
        }
        $nomor = $halaman_awal+1;
            while($row = mysqli_fetch_array($query)){
                ?>
        <div class="card">
            <h5 class="card-header bg-info"><?= $nomor++  ?>. <?= $row['nm_barang']?></h5>
            <div class="card-body">
            <table width="100%">
    <td width="40%"><img src="././file/<?= $row['foto']?>" alt="" width="40%"></td>
    <td width="30%">Stok <?= $row['jumlah']?></</td>
    <td width="30%"><form action="" method="post">
    <div class="row">
        <div class="col-6">
        <input type="number" name="jumlah" class="form-control">
        </div>
        <div class="col-6">
            <button class="btn btn-primary" type="submit" name="simpan">Pesan</button>
        </div>
    </div>
</form></td>
</table>
            </div>
        </div>
        <br>
        <?php
            }
        ?>

        <nav>
            <ul class="pagination justify-content">
                <li class="page-item">
                    <a class="page-link"
                        <?php if($halaman > 1){ echo "href='?page=menu&halaman=$previous&id_kategori=$kategori'"; } ?>>Previous</a>
                </li>
                <?php 
				for($x=1;$x<=$total_halaman;$x++){
					?>
                <li class="page-item"><a class="page-link"
                        href="?page=menu&halaman=<?php echo $x ?>&id_kategori=<?= $kategori ?>"><?php echo $x; ?></a></li>
                <?php
				}
				?>
                <li class="page-item">
                    <a class="page-link"
                        <?php if($halaman < $total_halaman) { echo "href='?page=menu&halaman=$next&id_kategori=$kategori'"; } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-6">sdsd</div>
</div>