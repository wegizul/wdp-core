<!DOCTYPE html>
<html lang="en">

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?= $this->session->userdata("nama"); ?> | <?= $page ?></title>

  <link rel="icon" href="<?= base_url("assets/"); ?>files/logo-rai-persegi.png" type="image/jpg">
  
  <!-- Google Font: Source Sans 3 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
  
  <!-- AdminLTE 4 CSS -->
  <link rel="stylesheet" href="<?= base_url("adminlte4"); ?>/css/adminlte.min.css">
  
  <!-- DataTables Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
  
  <!-- Select2 Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
  
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
  <!-- Daterangepicker -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

  <style>
    body {
      padding-right: 0px !important;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 45px;
      height: 25px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 25px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 17px;
      width: 17px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked+.slider {
      background-color: #4CAF50;
    }

    input:checked+.slider:before {
      transform: translateX(20px);
    }

    .info-box {
      display: flex;
      align-items: center;
      min-height: 90px;
    }

    .info-box-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      width: 60px;
      height: 60px;
      border-radius: 0.5rem;
    }

    .info-box-content {
      flex: 1;
      padding-left: 10px;
    }

    .info-box-text {
      font-size: 1rem;
      font-weight: 500;
    }

    .info-box-number {
      font-size: 1.2rem;
      font-weight: bold;
    }

    /* Responsif untuk tablet */
    @media (max-width: 768px) {
      .info-box-icon {
        font-size: 1.5rem;
        width: 50px;
        height: 50px;
      }

      .info-box-text {
        font-size: clamp(0.85rem, 1.8vw, 1rem);
      }

      .info-box-number {
        font-size: 1rem;
      }
    }

    /* Responsif untuk HP kecil */
    @media (max-width: 576px) {
      .info-box {
        min-height: 70px;
      }

      .info-box-icon {
        font-size: 1.2rem;
        width: 40px;
        height: 40px;
      }

      .info-box-text {
        font-size: 0.8rem;
      }

      .info-box-number {
        font-size: 0.9rem;
      }
    }
  </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <input type="hidden" id="base_link" value="<?= base_url(); ?>">
  
  <!-- Modal Konfirmasi Ya Tidak -->
  <div class="modal fade" id="frmKonfirm" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="jdlKonfirm">Konfirmasi Hapus</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="isiKonfirm"></div>
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="mode" id="mode">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" id="yaKonfirm"><i class="fas fa-trash-alt"></i> Hapus</button>
          <button data-bs-dismiss="modal" class="btn btn-primary btn-sm" id="tidakKonfirm"><i class="fas fa-times-circle"></i> Batal</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="frmKonfirm2" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="jdlKonfirm2">Konfirmasi Hapus</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="isiKonfirm2"></div>
          <input type="hidden" name="id" id="id2">
          <input type="hidden" name="mtl" id="mtl">
          <input type="hidden" name="jml" id="jml">
          <input type="hidden" name="mode" id="mode">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" id="yaKonfirm2"><i class="fas fa-trash-alt"></i> Hapus</button>
          <button data-bs-dismiss="modal" class="btn btn-primary btn-sm" id="tidakKonfirm2"><i class="fas fa-times-circle"></i> Batal</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="frmKonfirm3" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="jdlKonfirm3">Konfirmasi Logout</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="isiKonfirm3"></div>
          <input type="hidden" name="id" id="id3">
          <input type="hidden" name="mode" id="mode3">
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('Login/logout') ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Keluar</a>
          <button data-bs-dismiss="modal" class="btn btn-primary btn-sm" id="tidakKonfirm3"><i class="fas fa-times-circle"></i> Batal</button>
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="base_link" id="base_link" value="<?= base_url() ?>">

  <!-- Bootstrap modal Ubah Password -->
  <div class="modal fade" id="ubah_pass" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-lock"></i> Ubah Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" id="frm_ubahpass">
          <div class="modal-body form">
            <input type="hidden" name="pgnID" value="<?php $this->session->userdata("id_user"); ?>">
            <div class="mb-3">
              <label class="form-label">Password Lama</label>
              <input type="password" class="form-control infonya" name="log_pass" id="log_pass" value="" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password Baru</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control infonya" name="log_passBaru" id="log_passBaru" value="" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Konfirmasi Password Baru</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control infonya" name="log_passBaru2" id="log_passBaru2" value="" required>
              </div>
            </div>
            <div class="alert alert-danger d-none" role="alert" id="up_infoalert">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              <div id="up_pesan"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="up_simpan" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i> Simpan</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <?php if ($this->session->userdata("id_user")) { ?>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item" title="Logout">
              <a class="nav-link" href="#" role="button" onClick="logout(<?= $this->session->userdata("id_user") ?>)">
                <i class="fas fa-sign-out-alt"></i>
              </a>
            </li>
          </ul>
        <?php } else { ?>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url("Login"); ?>" role="button">
                <i class="fas fa-user"></i> Login
              </a>
            </li>
          </ul>
        <?php } ?>
        <!--end::End Navbar Links-->
      </div>
    </nav>
    <!--end::Header-->

    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <a href="<?= base_url() ?>" class="brand-link">
          <img src="<?= base_url("assets"); ?>/files/logo.png" alt="Logo" class="brand-image opacity-75 shadow">
          <span class="brand-text fw-light"><b>WDP CORE</b></span>
        </a>
      </div>
      <!--end::Sidebar Brand-->
      
      <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <!-- Sidebar user -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('assets/dist/img/user-blank.png'); ?>" class="img-size-50 rounded-circle me-3" alt="User Image" style="width: 40px; height: 40px;">
          </div>
          <div class="info">
            <a href="#" class="d-block text-white text-decoration-none"><?= $this->session->userdata("nama"); ?></a>
            <span class="badge text-bg-warning"><?php
              switch ($this->session->userdata("level")) {
                case 1:
                  echo "Super Admin";
                  break;
                case 2:
                  echo "Admin";
                  break;
                case 3:
                  echo "Investor";
                  break;
              }; ?></span>
          </div>
        </div>
        
        <nav class="mt-2">
          <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url("Dashboard/tampil"); ?>" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <?php if ($this->session->userdata("level") < 3) : ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-suitcase"></i>
                  <p>
                    Data Master
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url("Pengguna/tampil") ?>" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Manajemen User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url("KategoriProduk/tampil") ?>" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Kategori Produk</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url("DataProduk/tampil") ?>" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Produk</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif; ?>
            <?php if ($this->session->userdata('level') < 3) { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file-excel"></i>
                  <p>
                    Laporan
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url("LapPembelian/tampil") ?>" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Laporan Pembelian</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            
            <li class="nav-header">PENGATURAN</li>
            <li class="nav-item">
              <a href="#" data-bs-target="#ubah_pass" data-bs-toggle="modal" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>Ubah Password</p>
              </a>
            </li>
          </ul>
          <!--end::Sidebar Menu-->
        </nav>
      </div>
      <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->

    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0"><?= $page ?></h3>
            </div>
          </div>
        </div>
      </div>
      <!--end::App Content Header-->

      <!--begin::App Content-->
      <div class="app-content">
        <div class="container-fluid">

        <script>
          function logout(id) {
            event.preventDefault();
            $("#log_id").val(id);
            $("#jdlKonfirm3").html("<i class='fas fa-sign-out-alt fa-xs'></i> Logout");
            $("#isiKonfirm3").html("Apakah anda ingin Keluar Aplikasi ?");
            var myModal = new bootstrap.Modal(document.getElementById('frmKonfirm3'));
            myModal.show();
          }

          /** add active class and stay opened when selected */
          document.addEventListener('DOMContentLoaded', function() {
            var url = window.location.href;
            
            // for sidebar menu
            document.querySelectorAll('.sidebar-menu a').forEach(function(link) {
              if (link.href === url) {
                link.classList.add('active');
                
                // Open parent menu if in treeview
                var parent = link.closest('.nav-treeview');
                if (parent) {
                  parent.style.display = 'block';
                  var parentItem = parent.closest('.nav-item');
                  if (parentItem) {
                    parentItem.classList.add('menu-open');
                    var parentLink = parentItem.querySelector(':scope > .nav-link');
                    if (parentLink) {
                      parentLink.classList.add('active');
                    }
                  }
                }
              }
            });
          });
        </script>