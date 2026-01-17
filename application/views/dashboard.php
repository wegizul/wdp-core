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
    .small-box {
      border-radius: 0.5rem;
      position: relative;
      display: block;
      margin-bottom: 20px;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .small-box > .inner {
      padding: 1rem;
    }
    
    .small-box h3 {
      font-size: 2.2rem;
      font-weight: 700;
      margin: 0 0 10px 0;
      white-space: nowrap;
      padding: 0;
    }
    
    .small-box p {
      font-size: 1rem;
      margin-bottom: 0;
    }
    
    .small-box .small-box-footer {
      position: relative;
      text-align: center;
      padding: 3px 0;
      display: block;
      z-index: 10;
      background-color: rgba(0, 0, 0, 0.1);
      text-decoration: none;
      border-radius: 0 0 0.5rem 0.5rem;
    }
    
    .small-box .small-box-icon {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 3rem;
      opacity: 0.3;
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
      border-radius: 8px;
    }

    .warning-stok a {
      font-weight: bold;
    }

    .warning-expired {
      background-color: rgba(249, 191, 191, 0.51);
      border-radius: 8px;
    }

    .warning-expired a {
      color: #d00000ff;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="inner p-2">
    <!-- Row 1: Statistics -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3><?= $produk ?></h3>
            <p>Total Produk</p>
          </div>
          <div class="small-box-icon">
            <i class="fas fa-boxes"></i>
          </div>
          <a href="<?= base_url('DataProduk/tampil') ?>" class="small-box-footer link-light">
            Kelola Produk <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>100</h3>
            <p>Total Customer</p>
          </div>
          <div class="small-box-icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <a href="<?= base_url('DataPelanggan/tampil') ?>" class="small-box-footer link-light">
            Kelola Customer <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
          <div class="inner">
            <h3>Rp 50.000.000</h3>
            <p>Penjualan Hari Ini</p>
          </div>
          <div class="small-box-icon">
            <i class="fas fa-cash-register"></i>
          </div>
          <a href="<?= base_url('LapPenjualan/tampil') ?>" class="small-box-footer link-dark">
            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
          <div class="inner">
            <h3>Rp 35.000.000</h3>
            <p>Total Piutang</p>
          </div>
          <div class="small-box-icon">
            <i class="fas fa-credit-card"></i>
          </div>
          <a href="<?= base_url('PiutangCustomer/tampil') ?>" class="small-box-footer link-light">
            Kelola Piutang <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Row 2: Warnings -->
    <div class="row g-3 mb-4 mt-2">
      <div class="col-md-6">
        <div class="card p-3 border-warning border-start border-4">
          <h5 class="fw-bold mb-2">
            <i class="fa-solid fa-triangle-exclamation text-warning"></i> Peringatan Stok Rendah
            <span class="badge text-bg-warning float-end">25 Item</span>
          </h5>
          <div class="warning-stok p-4 my-2">
            <p class="mb-1">Ada <b>25</b> item dengan stok di bawah minimal yang perlu direstock.</p>
            <a href="<?= base_url('StokBarang/tampil') ?>" class="text-decoration-none fw-bold text-warning">Lihat Detail →</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-3 border-danger border-start border-4">
          <h5 class="fw-bold mb-2">
            <i class="fa-solid fa-calendar-xmark text-danger"></i> Peringatan Expired
            <span class="badge text-bg-danger float-end">40 Batch</span>
          </h5>
          <div class="warning-expired p-4 my-2">
            <p class="mb-1">Ada <b>40</b> batch yang expired atau akan expired dalam 3 bulan.</p>
            <a href="<?= base_url('StokBarang/tampil') ?>" class="text-decoration-none fw-bold text-danger">Lihat Detail →</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Row 3: Quick Actions -->
    <div class="card p-3">
      <h6 class="fw-bold mb-3"><i class="fa-solid fa-bolt"></i> Aksi Cepat</h6>
      <div class="row quick-action g-3">
        <div class="col-md-3">
          <a href="<?= base_url('Penjualan/tambah') ?>" class="text-decoration-none text-dark">
            <div class="card p-3 text-center">
              <div class="fs-3 text-primary mb-2"><i class="fa-solid fa-plus-circle fa-xl"></i></div>
              <h6 class="mb-0">Transaksi Baru</h6>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="<?= base_url('DataProduk/tampil') ?>" class="text-decoration-none text-dark">
            <div class="card p-3 text-center">
              <div class="fs-3 text-primary mb-2"><i class="fa-solid fa-box fa-xl"></i></div>
              <h6 class="mb-0">Tambah Barang</h6>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="<?= base_url('DataPelanggan/tampil') ?>" class="text-decoration-none text-dark">
            <div class="card p-3 text-center">
              <div class="fs-3 text-primary mb-2"><i class="fa-solid fa-user-plus fa-xl"></i></div>
              <h6 class="mb-0">Tambah Customer</h6>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="<?= base_url('LapLabaRugi/tampil') ?>" class="text-decoration-none text-dark">
            <div class="card p-3 text-center">
              <div class="fs-3 text-primary mb-2"><i class="fa-solid fa-chart-line fa-xl"></i></div>
              <h6 class="mb-0">Lihat Laporan</h6>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>