<?php
if ($_SESSION['level'] == "Admin" || $_SESSION['level'] == "Super Admin") {
?>
  <div class="row">
    <div class="col-6">
      <form action="halaman/laba/laba_kotor.php" method="get">
        <div class="row">
          <div class="col-4">
            <label for="">Dari</label>
            <input type="date" name="dari" class="form-control" required>
          </div>
          <div class="col-4">
            <label for="">Sampai</label>
            <input type="date" name="sampai" class="form-control" required>
          </div>
          <div class="col-4">
            <br>
            <button class="btn btn-warning">Laba Kotor</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-6">
      <form action="halaman/laba/laba_bersih.php" method="get">
        <div class="row">
          <div class="col-4">
            <label for="">Dari</label>
            <input type="date" name="dari" class="form-control" required>
          </div>
          <div class="col-4">
            <label for="">Sampai</label>
            <input type="date" name="sampai" class="form-control" required>
          </div>
          <div class="col-4">
            <br>
            <button class="btn btn-warning">Laba bersih</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php
}
?>
<hr>
<div class="row">
  <div class="col-12">
    <form action="" method="get">
      <input type="hidden" name="page" value="dashboard">
      <div class="row">
        <div class="col-5">
          <input type="date" name="dari" value="<?= @$_GET['dari'] ?>" class="form-control">
        </div>
        <div class="col-5">
          <input type="date" name="sampai" value="<?= @$_GET['sampai'] ?>" class="form-control">
        </div>
        <div class="col-2">
          <button class="btn btn-success" type="submit">Filter</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-6">
    <h5>GRAFIK MENU TERLARIS</h5>
    <div>
      <canvas id="myChart"></canvas>
    </div>
  </div>
  <div class="col-6">
    <h5>GRAFIK PENJUALAN</h5>
    <div>
      <canvas id="myChart1"></canvas>
    </div>
  </div>
</div>
<br>
<div class="row">
  <?php
  include "././koneksi.php";
  $qr = mysqli_query($koneksi, "SELECT * FROM `link` order BY id_link DESC");
  while ($rl = mysqli_fetch_array($qr)) {
  ?>
    <div class="col-3">
      <div class="ratio ratio-16x9">
        <iframe src="<?= $rl['link'] ?>" title="YouTube video" allowfullscreen></iframe>
      </div>
      <br>
    </div>
  <?php
  }
  ?>
</div>
<?php
include "././koneksi.php";

if (isset($_GET['dari'])) {
  $dari = $_GET['dari'];
  $sampai = $_GET['sampai'];
  $query_order = mysqli_query($koneksi, "SELECT 
  MONTHNAME(tgl) AS bulan,
  COUNT(*) AS data 
FROM 
  `order` 
WHERE 
  harga != 0 AND `order`.tgl BETWEEN '$dari' AND '$sampai'
GROUP BY 
  MONTH(tgl), MONTHNAME(tgl);
");
} else {
  $query_order = mysqli_query($koneksi, "SELECT 
  MONTHNAME(tgl) AS bulan,
  COUNT(*) AS data 
FROM 
  `order` 
WHERE 
  harga != 0 
GROUP BY 
  MONTH(tgl), MONTHNAME(tgl);
");
}

while ($row_order = mysqli_fetch_array($query_order)) {
  $bulan[] = $row_order['bulan'];
  $data[] = $row_order['data'];
}

if (isset($_GET['dari'])) {
  $dari = $_GET['dari'];
  $sampai = $_GET['sampai'];
  $query_barang = mysqli_query($koneksi, "SELECT SUM(total) AS total ,pesanan.id_barang,nm_barang FROM `pesanan` JOIN barang ON barang.id_barang = pesanan.id_barang WHERE pesanan.tgl BETWEEN '$dari' AND '$sampai' GROUP BY pesanan.id_barang");
} else {
  $query_barang = mysqli_query($koneksi, "SELECT SUM(total) AS total ,pesanan.id_barang,nm_barang FROM `pesanan` JOIN barang ON barang.id_barang = pesanan.id_barang WHERE pesanan.tgl GROUP BY pesanan.id_barang");
}
while ($row_barang = mysqli_fetch_array($query_barang)) {
  $nm_barang[] = $row_barang['nm_barang'];
  $total[] = $row_barang['total'];
}

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($nm_barang) ?>,
      datasets: [{
        label: '# of Votes',
        data: <?= json_encode($total) ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  const ctx1 = document.getElementById('myChart1');

  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: <?= json_encode($bulan) ?>,
      datasets: [{
        label: '# of Votes',
        data: <?= json_encode($data) ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>