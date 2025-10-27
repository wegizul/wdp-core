<div class="inner">
	<div class="row">
		<div class="col-lg-12">
			<div class="card mt-3">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6 pl-0">
							<i class="fas fa-cube mb-3"></i> <?= $page ?>
						</div>
						<div class="col-md-6 pl-0">
							<div class="form-group">
								<a href="javascript:tambah()" class="btn btn-primary" style="float: right;"><i class="fa fa-plus-circle"></i> &nbsp; Tambah Kategori</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body table-responsive pt-0">
					<table class="table table-striped table-bordered table-hover" id="tabel-data" width="100%" style="font-size:100%;">
						<thead>
							<tr>
								<th style="width: 5px;">No</th>
								<th>Nama Kategori</th>
								<th>Tanggal Dibuat</th>
								<th style="width: 10%;">Aksi</th>
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

<div class="modal fade" id="modal_kategori_produk" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title"><i class="fas fa-cube"></i> Form Kategori Produk</h6>
				<span type="button" aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close" onclick="reset_form()">&times;</span>
			</div>
			<form role="form col-lg" name="TambahEdit" id="frm_kategori_produk">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="kp_id" name="kp_id" value="">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Nama Kategori</label>
								<input type="text" class="form-control" name="kp_nama" id="kp_nama" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="kp_simpan" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- DataTables -->
<script src="<?= base_url("assets"); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.colVis.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/pdfmake.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/vfs_fonts.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/datatables-buttons/js/jszip.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url("assets"); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?= base_url("assets"); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url("assets"); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Select 2 -->
<script src="<?= base_url("assets"); ?>/plugins/select2/select2.js"></script>

<!-- Toastr -->
<script src="<?= base_url("assets"); ?>/plugins/toastr/toastr.min.js"></script>

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<script>
	function drawTable() {
		$('#tabel-data').DataTable({
			"destroy": true,
			dom: 'Bfrtip',
			lengthMenu: [
				[10, 25, 50, -1],
				['10 rows', '25 rows', '50 rows', 'Show all']
			],
			buttons: [],
			"responsive": true,
			"sort": true,
			"processing": true,
			"serverSide": true,
			"searching": false,
			"order": [],
			"ajax": {
				"url": "ajax_list_kategori_produk/",
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
		$("#kp_id").val(0);
		$("frm_kategori_produk").trigger("reset");
		$('#modal_kategori_produk').modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	$("#frm_kategori_produk").submit(function(e) {
		e.preventDefault();
		$("#kp_simpan").html("<i class='fas fa-spinner fa-spin'></i> Menyimpan...");
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
					$("#modal_kategori_produk").modal("hide");
				} else {
					toastr.error(res.desc);
				}
				$("#kp_simpan").html("<i class='fas fa-check-circle'></i> Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#kp_simpan").html("<i class='fas fa-check-circle'></i> Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function hapus_kategori_produk(id) {
		event.preventDefault();
		$("#kp_id").val(id);
		$("#jdlKonfirm").html("<i class='fas fa-exclamation-triangle fa-sm'></i> Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		$("#frmKonfirm").modal({
			show: true,
			keyboard: false,
			backdrop: 'static'
		});
	}

	function ubah_kategori_produk(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			data: "kp_id=" + id,
			dataType: "json",
			success: function(data) {
				var obj = Object.entries(data);
				obj.map((dt) => {
					$("#" + dt[0]).val(dt[1]);
				});
				$(".inputan").attr("disabled", false);
				$("#modal_kategori_produk").modal({
					show: true,
					keyboard: false,
					backdrop: 'static'
				});
				return false;
			}
		});
	}

	function reset_form() {
		$("#kp_id").val(0);
		$("#frm_kategori_produk")[0].reset();
	}

	$("#yaKonfirm").click(function() {
		var id = $("#kp_id").val();
		$("#isiKonfirm").html("<i class='fas fa-spinner fa-spin'></i> Sedang menghapus data...");
		$(".btn").attr("disabled", true);
		$.ajax({
			type: "GET",
			url: "hapus/" + id,
			success: function(d) {
				var res = JSON.parse(d);
				if (res.success) {
					toastr.success(res.desc);
					$("#frmKonfirm").modal("hide");
					drawTable();
				} else {
					toastr.error(res.desc + " (" + res.err + ")");
				}
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	});

	$('.tgl').daterangepicker({
		locale: {
			format: 'DD/MM/YYYY'
		},
		showDropdowns: true,
		singleDatePicker: true,
		"autoApply": true,
		opens: 'left'
	});

	$(document).ready(function() {
		drawTable();
	});
</script>