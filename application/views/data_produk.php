<div class="inner">
	<div class="row">
		<div class="col-lg-12">
			<div class="card mt-3">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6 ps-0">
							<i class="fas fa-cube mb-3"></i> <?= $page ?>
						</div>
						<div class="col-md-6 ps-0">
							<div class="mb-3">
								<a href="javascript:tambah()" class="btn btn-primary" style="float: right;"><i class="fa fa-plus-circle"></i> &nbsp; Tambah Produk</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body table-responsive">
					<div class="d-flex justify-content-end mb-2">
						<button class="btn btn-sm btn-info shadow" onclick="exportPDF()">
							<i class="fas fa-file-pdf"></i> Export PDF
						</button>
					</div>
					<table class="table table-striped table-hover" id="tabel-data" width="100%" style="font-size:100%;">
						<thead>
							<tr>
								<th style="width: 5%;">No</th>
								<th>Gambar</th>
								<th>Kode</th>
								<th>Nama Produk</th>
								<th>Kategori</th>
								<th>Stok Minimal</th>
								<th>Total Stok</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="3" align="center">Tidak ada data</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_data_produk" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title"><i class="fas fa-cube"></i> Form Produk</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="reset_form()"></button>
			</div>
			<form role="form col-lg" name="TambahEdit" id="frm_data_produk">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="prd_id" name="prd_id" value="">
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">Kode Produk</label>
								<div class="input-group">
									<span class="input-group-text"><i class="fas fa-barcode"></i></span>
									<input type="text" class="form-control" name="prd_kode" id="prd_kode" autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="mb-3">
								<label class="form-label">Nama Produk</label>
								<input type="text" class="form-control" name="prd_nama" id="prd_nama" autocomplete="off" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">Gudang</label>
								<select class="form-select select2" name="prd_gudang_id" id="prd_gudang_id" style="width: 100%;" required>
									<option value="">Pilih</option>
									<?php foreach ($gudang as $g) { ?>
										<option value="<?= $g->gd_id ?>"><?= $g->gd_nama ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">Kategori</label>
								<select class="form-select select2" name="prd_kategori" id="prd_kategori" style="width: 100%;" required>
									<option value="">Pilih</option>
									<?php foreach ($kategori as $k) { ?>
										<option value="<?= $k->kp_id ?>"><?= $k->kp_nama ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">Stok Minimal</label>
								<input type="number" min="0" class="form-control" name="prd_stok_minimal" id="prd_stok_minimal" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label d-block">Konversi Satuan</label>
								<div class="row g-2 align-items-center">
									<div class="col-12 col-md-4">
										<select class="form-select" name="prd_satuan_konversi" id="prd_satuan_konversi" required>
											<option value="">Pilih</option>
											<?php foreach ($satuan as $s) { ?>
												<option value="<?= $s->sb_id ?>"><?= $s->sb_nama ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-auto text-center">
										<span>=</span>
									</div>
									<div class="col-12 col-md-3">
										<input class="form-control" type="number" min="0" name="prd_nilai_konversi" id="prd_nilai_konversi" placeholder="Nilai">
									</div>
									<div class="col-12 col-md-4">
										<select class="form-select" name="prd_satuan" id="prd_satuan" required>
											<option value="">Pilih</option>
											<?php foreach ($satuan as $s) { ?>
												<option value="<?= $s->sb_id ?>"><?= $s->sb_nama ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Foto Produk</label><small><i> (ukuran foto 1080 x 1080 pixel)</i></small>
								<div id="preview"></div>
								<input type="file" accept=".jpg, .jpeg, .png" class="form-control" name="prd_foto" id="prd_foto">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="prd_simpan" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_rincian" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content shadow rounded-3">
			<div class="modal-header">
				<h5 class="modal-title">Detail Batch Barang</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3 text-center">
					<table class="table table-sm">
						<thead class="bg-light">
							<tr>
								<th>NOMOR BATCH</th>
								<th>TANGGAL EXPIRED</th>
								<th>STOK</th>
								<th>HARGA MODAL</th>
								<th>HARGA JUAL</th>
							</tr>
						</thead>
						<tbody class="list-batch">
							<!-- Data batch akan diisi via AJAX -->
						</tbody>
					</table>
					<i style="text-align: center;" id="ket">Belum ada transaksi Batch untuk produk ini</i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<script>
	function drawTable() {
		$('#tabel-data').DataTable({
			"destroy": true,
			lengthMenu: [
				[10, 25, 50, -1],
				['10 rows', '25 rows', '50 rows', 'Show all']
			],
			buttons: [],
			"responsive": true,
			"sort": true,
			"processing": true,
			"serverSide": true,
			"searching": true,
			"order": [],
			"ajax": {
				"url": "ajax_list_data_produk/",
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [-1],
				"orderable": false,
			}, ],
			"initComplete": function(settings, json) {
				$("#process").html("<i class='fas fa-spinner fa-spin'></i> Process...")
				$(".btn").attr("disabled", false);
			}
		});
	}

	function tambah() {
		$("#prd_id").val(0);
		$("frm_data_produk").trigger("reset");
		var myModal = new bootstrap.Modal(document.getElementById('modal_data_produk'));
		myModal.show();
	}

	$("#frm_data_produk").submit(function(e) {
		e.preventDefault();
		$("#prd_simpan").html("<i class='fas fa-spinner fa-spin'></i> Menyimpan...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "POST",
			url: "simpan",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(d) {
				var res = JSON.parse(d);
				if (res.success) {
					toastr.success(res.desc);
					drawTable();
					reset_form();
					bootstrap.Modal.getInstance(document.getElementById('modal_data_produk')).hide();
				} else {
					toastr.error(res.desc);
				}
				$("#prd_simpan").html("<i class='fas fa-check-circle'></i> Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#prd_simpan").html("<i class='fas fa-check-circle'></i> Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function ubah_data_produk(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			data: "prd_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					if (dt[0] == "prd_foto") {
						$("#preview").append('<img src="<?= base_url('assets/files/data_produk/') ?>' + dt[1] + '" width="100px">');
						$("#prd_foto").val();
					} else {
						$("#" + dt[0]).val(dt[1]).trigger('change');
					}
				});
				$(".inputan").attr("disabled", false);
				var myModal = new bootstrap.Modal(document.getElementById('modal_data_produk'));
				myModal.show();
				return false;
			}
		});
	}

	function reset_form() {
		$("#prd_id").val(0);
		$("#frm_data_produk")[0].reset();
		$("#preview").html('');
		$("#prd_kategori").trigger('change');
	}

	function hapus_data_produk(id) {
		event.preventDefault();
		$("#prd_id").val(id);
		$("#jdlKonfirm").html("<i class='fas fa-exclamation-circle fa-sm'></i> Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		var myModal = new bootstrap.Modal(document.getElementById('frmKonfirm'));
		myModal.show();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#prd_id").val();
		$("#isiKonfirm").html("<i class='fas fa-spinner fa-spin'></i> Sedang menghapus data...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "GET",
			url: "hapus/" + id,
			success: function(d) {
				var res = JSON.parse(d);
				if (res.success) {
					toastr.success(res.desc);
					bootstrap.Modal.getInstance(document.getElementById('frmKonfirm')).hide();
					drawTable();
				} else {
					toastr.error(res.desc + " (" + res.err + ")");
				}
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				toastr.error('Data tidak bisa dihapus karena berelasi dengan tabel lain');
				$(".btn").attr("disabled", false);
			}
		});
	});

	function lihatBatch(id) {
		var myModal = new bootstrap.Modal(document.getElementById('modal_rincian'));
		myModal.show();
		ambilBatch(id);
	}

	function ambilBatch(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari_batch",
			data: {
				prd_id: id
			},
			dataType: "json",
			success: function(data) {
				if (data.success) {
					let html = "";
					data.batch.forEach(function(item) {
						html += `
                    <tr>
						<td>${item.btc_nomor}</td>
                        <td>${item.btc_expired}</td>
                        <td>${item.btc_qty} ${item.sb_nama}</td>
                        <td>Rp ${formatRupiah(item.btc_harga_modal)}</td>
                        <td>Rp ${formatRupiah(item.btc_harga_jual)}</td>
                    </tr>`;
					});
					$(".list-batch").html(html);
					$("#ket").hide();
				} else {
					$(".list-batch").html('');
					$("#ket").show();
				}
			}
		});
	}

	// fungsi format angka ke ribuan (pakai titik)
	function formatRupiah(angka) {
		return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}

	$('.select2').select2({
		theme: 'bootstrap-5'
	});

	function exportPDF() {
		var url = "<?= base_url('DataProduk/pdf') ?>";
		window.open(url, '_blank');
	}

	$(document).ready(function() {
		drawTable();
	});
</script>