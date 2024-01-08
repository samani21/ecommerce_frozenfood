<div class="row">
	
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
<?php
include "././koneksi.php";
	$query_order = mysqli_query($koneksi,"SELECT MONTHNAME(tgl) as bulan,COUNT(tgl) AS data FROM `order` WHERE NOT harga = 0 GROUP BY MONTH(tgl)");
	while($row_order = mysqli_fetch_array($query_order)){
		$bulan[]=$row_order['bulan'];
		$data[]=$row_order['data'];
	}

	$query_barang = mysqli_query($koneksi,"SELECT SUM(total) AS total ,pesanan.id_barang,nm_barang FROM `pesanan` JOIN barang ON barang.id_barang = pesanan.id_barang GROUP BY pesanan.id_barang");
	while($row_barang = mysqli_fetch_array($query_barang)){
		$nm_barang[]=$row_barang['nm_barang'];
		$total[]=$row_barang['total'];
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