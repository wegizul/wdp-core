<!DOCTYPE html>
<html lang="id">

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<style>
		body {
			background-color: #f5f9ff;
		}

		.card {
			border: none;
			border-radius: 12px;
			box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
		}

		.card h5 {
			font-weight: 600;
		}

		.quick-action .card {
			transition: 0.3s;
			cursor: pointer;
			background-color: rgba(124, 167, 246, 0.43);
		}

		.quick-action .card:hover {
			transform: translateY(-3px);
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
			background-color: rgba(59, 128, 255, 0.41);
		}

		.warning-stok {
			background-color: rgba(249, 240, 191, 0.51);
		}

		.warning-stok a {
			/* color: #977c0fff; */
			font-weight: bold;
		}

		.warning-expired {
			background-color: rgba(249, 191, 191, 0.51);
		}

		.warning-expired a {
			color: #d00000ff;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="inner p-4">
		<div class="row">
			<div class="col-lg-3 col-6">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?= $produk ?></h3>

						<p>Total Produk</p>
					</div>
					<div class="icon">
						<i class="fas fa-boxes"></i>
					</div>
					<a href="<?= base_url('DataProduk/tampil') ?>" class="small-box-footer">
						Kelola Produk <i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-success">
					<div class="inner">
						<h3>100</h3>

						<p>Total Customer</p>
					</div>
					<div class="icon">
						<i class="fas fa-user-tie"></i>
					</div>
					<a href="<?= base_url('DataPelanggan/tampil') ?>" class="small-box-footer">
						Kelola Customer <i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>Rp 50.000.000</h3>

						<p>Penjualan Hari Ini</p>
					</div>
					<div class="icon">
						<i class="fas fa-cash-register"></i>
					</div>
					<a href="<?= base_url('LapPenjualan/tampil') ?>" class="small-box-footer">
						Lihat Detail <i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-6">
				<div class="small-box bg-danger">
					<div class="inner">
						<h3>Rp 35.000.000</h3>

						<p>Total Piutang</p>
					</div>
					<div class="icon">
						<i class="fas fa-credit-card"></i>
					</div>
					<a href="<?= base_url('PiutangCustomer/tampil') ?>" class="small-box-footer">
						Kelola Piutang <i class="fas fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		</div>

		<!-- Row 2 -->
		<div class="row g-3 mb-4 mt-4">
			<div class="col-md-6">
				<div class="card p-3 border-warning border-start border-4">
					<h5 class="fw-bold mb-2">
						<i class="fa-solid fa-triangle-exclamation text-orange"></i> Peringatan Stok Rendah
						<span class="badge bg-warning text-dark" style="float:right">25 Item</span>
					</h5>
					<div class="warning-stok rounded-lg p-4 my-3">
						<p class="mb-1">Ada <b>25</b> item dengan stok di bawah minimal yang perlu direstock.</p>
						<a href="<?= base_url('StokBarang/tampil') ?>" class="text-decoration-none fw-bold text-orange">Lihat Detail →</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card p-3 border-danger border-start border-4">
					<h5 class="fw-bold mb-2">
						<i class="fa-solid fa-calendar-xmark text-danger"></i> Peringatan Expired
						<span class="badge bg-danger" style="float: right;">40 Batch</span>
					</h5>
					<div class="warning-expired rounded-lg p-4 my-3">
						<p class="mb-1">Ada <b>40</b> batch yang expired atau akan expired dalam 3 bulan.</p>
						<a href="<?= base_url('StokBarang/tampil') ?>" class="text-decoration-none fw-bold text-danger">Lihat Detail →</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Row 3 -->
		<div class="card p-3">
			<h6 class="fw-bold mb-3"><i class="fa-solid fa-bolt"></i> Aksi Cepat</h6>
			<div class="row quick-action g-3">
				<div class="col-md-3">
					<a href="<?= base_url('Penjualan/tambah') ?>" style="text-decoration: none; color:black">
						<div class="card p-3 text-center">
							<div class="fs-3 text-lightblue mb-2"><i class="fa-solid fa-plus-circle fa-xl"></i></div>
							<h6>Transaksi Baru</h6>
						</div>
					</a>
				</div>
				<div class="col-md-3">
					<a href="<?= base_url('DataProduk/tampil') ?>" style="text-decoration: none; color:black">
						<div class="card p-3 text-center">
							<div class="fs-3 text-lightblue mb-2"><i class="fa-solid fa-box fa-xl"></i></div>
							<h6>Tambah Barang</h6>
						</div>
					</a>
				</div>
				<div class="col-md-3">
					<a href="<?= base_url('DataPelanggan/tampil') ?>" style="text-decoration: none; color:black">
						<div class="card p-3 text-center">
							<div class="fs-3 text-lightblue mb-2"><i class="fa-solid fa-user-plus fa-xl"></i></div>
							<h6>Tambah Customer</h6>
						</div>
					</a>
				</div>
				<div class="col-md-3">
					<a href="<?= base_url('LapLabaRugi/tampil') ?>" style="text-decoration: none; color:black">
						<div class="card p-3 text-center">
							<div class="fs-3 text-lightblue mb-2"><i class="fa-solid fa-chart-line fa-xl"></i></div>
							<h6>Lihat Laporan</h6>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>