 <!-- Theme style -->
 <link rel="stylesheet" href="<?= base_url("assets"); ?>/dist/css/adminlte.min.css">
 <!-- Tempusdominus Bbootstrap 4 -->
 <link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

 <!-- DataTables -->
 <link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
 <link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

 <link rel="icon" href="<?= base_url("assets/"); ?>files/logo.png" type="image/jpg">
 <!-- Font Awesome Icons -->
 <script src="https://kit.fontawesome.com/c1fd40eeb3.js" crossorigin="anonymous"></script>

 <!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

 <style>
     table {
         font-family: Arial, sans-serif;
         font-size: 100%;
         caption-side: top;
     }

     .daftar-barang {
         font-size: 20px;
     }

     img {
         display: block;
         margin-left: auto;
         margin-right: auto;
     }

     span,
     b {
         margin-bottom: 4px;
         font-size: 20px;
     }

     .invoice-info span,
     .invoice-info b {
         line-height: 30px;
     }
 </style>
 <div class="inner">
     <div class="row">
         <div class="col-lg-12 d-flex justify-content-center">
             <div class="card m-3" style="width: 90%;">
                 <div class="card-body">
                     <table class="table table-borderless" style="width: 100%;">
                         <thead>
                             <tr>
                                 <td>
                                     <b style="font-size: 47px;">INVOICE</b>
                                     <h5 style="margin-top: -5px;"><b><?= $penjualan->pjl_faktur ?></b></h5>
                                 </td>
                                 <td></td>
                                 <td>
                                     <img src="https://so.webdeveloperpku.com/assets/files/logo.png" width="300px" style="float: right;">
                                 </td>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td style="height: 30px;"></td>
                             </tr>
                             <tr>
                                 <td class="invoice-info">
                                     <b class="text-secondary">DITAGIHKAN KEPADA</b><br><br>
                                     <b><?= $penjualan->pgn_nama ?></b><br>
                                     <span><?= $penjualan->pgn_alamat ?></span><br>
                                     <span><?= $penjualan->pgn_notelp ?></span><br>
                                 </td>
                                 <td></td>
                                 <td class="text-right invoice-info">
                                     <b class="text-secondary">DETAIL TRANSAKSI</b><br><br>
                                     <span>Tanggal Invoice: <b><?= date('d F Y', strtotime($penjualan->pjl_tanggal)) ?></b>
                                     </span><br>
                                     <?php if ($penjualan->pjl_status_bayar == 2) { ?>
                                         <span>Status:
                                             <b class="text-success">LUNAS</b>
                                         </span>
                                     <?php } else { ?>
                                         <span>Jatuh Tempo: <b class="text-orange"><?= date('d F Y', strtotime($penjualan->pjl_jatuh_tempo)) ?></b>
                                         </span><br>
                                         <span>Status:
                                             <b class="text-danger">BELUM LUNAS</b>
                                         </span>
                                     <?php } ?>
                                     <br>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="3">
                                     <!-- Detail Barang -->
                                     <table class="table table-bordered mb-3 mt-4 daftar-barang">
                                         <thead class="table">
                                             <tr>
                                                 <th>BARANG</th>
                                                 <th class="text-center">QTY</th>
                                                 <th class="text-center">HARGA</th>
                                                 <th class="text-center">DISKON</th>
                                                 <th class="text-right">SUBTOTAL</th>
                                             </tr>
                                         </thead>
                                         <tbody class="list-barang">
                                             <?php foreach ($produk as $p) { ?>
                                                 <tr>
                                                     <td><?= $p->prd_nama ?></td>
                                                     <td class="text-center"><?= $p->pjd_qty ?></td>
                                                     <td class="text-center">Rp <?= number_format($p->pjd_harga, 0, ',', '.') ?></td>
                                                     <td class="text-center"><?= $p->pjd_diskon ?> %</td>
                                                     <td class="text-right">Rp <?= number_format($p->pjd_subtotal, 0, ',', '.') ?></td>
                                                 </tr>
                                             <?php } ?>
                                         </tbody>
                                     </table>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                 </td>
                                 <td>
                                     <span>Subtotal:</span><br>
                                     <span>Diskon Transaksi:</span><br>
                                     <span>Pajak (11%):</span><br>

                                     <hr>
                                     <b style="font-size: 25px;">Total Tagihan:</b>
                                 </td>
                                 <td class="text-right">
                                     <span class="subtotal">Rp <?= number_format($penjualan->pjl_subtotal, 0, ',', '.') ?></span><br>
                                     <span class="diskon">- Rp <?= number_format($penjualan->pjl_diskon_transaksi, 0, ',', '.') ?></span><br>
                                     <span class="pajak">+ Rp <?= number_format($penjualan->pjl_tax, 0, ',', '.') ?></span><br>
                                     <hr>
                                     <b class="total_tagihan" style="font-size: 35px;">Rp <?= number_format($penjualan->pjl_total_tagihan, 0, ',', '.') ?></b>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
                 <hr size="2px" width="80%" class="mx-auto">
                 <div class="card-footer">
                     <p class="text-center">Terimakasih atas kepercayaan Anda terhadap produk kami<br>Kami selalu menantikan orderan Anda berikutnya</p>
                 </div>
             </div>
         </div>
     </div>
 </div>