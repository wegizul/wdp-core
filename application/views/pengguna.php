<div class="inner">
	<div class="row">
		<div class="col-lg-12">
			<div class="card mt-3">
				<div class="card-header">
					<div class="row">
						<div class="col-md-6">
							<i class="fas fa-user-cog fa-sm"></i> <?= $page ?>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<a href="javascript:log_tambah()" class="btn btn-primary" style="float: right;"><i class="fa fa-user-plus"></i> &nbsp; Tambah User</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped table-hover" id="tabel-pengguna" width="100%" style="font-size:100%;">
						<thead>
							<tr>
								<th style="width: 5%;">No</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Username</th>
								<th>Role</th>
								<th>Status</th>
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

<div class="modal fade" id="modal_pengguna" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title"><i class="fas fa-user-cog fa-sm"></i> Form User</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="reset_form()"></button>
			</div>
			<form role="form col-lg-6" name="Pengguna" id="frm_pengguna">
				<div class="modal-body form">
					<div class="row">
						<input type="hidden" id="log_id" name="log_id" value="">

						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Nama</label>
								<input type="text" class="form-control" name="log_nama" id="log_nama" autocomplete="off" required>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Email</label>
								<input type="email" class="form-control" name="log_email" id="log_email" autocomplete="off">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Username</label>
								<input type="text" class="form-control" name="log_user" id="log_user" autocomplete="off" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Password</label>
								<input type="password" class="form-control" name="log_pass" id="log_pass" placeholder="Password" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Role</label>
								<select class="form-select" name="log_level" id="log_level">
									<option value="2">Admin</option>
									<option value="3">Investor</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Aktif</label>
								<select class="form-select" name="log_aktif" id="log_aktif">
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="log_simpan" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- This Application made with love by Wegi Zulianda
author: wegizulianda@gmail.com
company: https://webdeveloperpku.com -->

<!-- Custom Java Script -->
<script>
	function drawTable() {
		$('#tabel-pengguna').DataTable({
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
			"order": [],
			"ajax": {
				"url": "ajax_list_pengguna/",
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

	function log_tambah() {
		$("#log_id").val(0);
		$("frm_pengguna").trigger("reset");
		var myModal = new bootstrap.Modal(document.getElementById('modal_pengguna'));
		myModal.show();
	}

	$("#frm_pengguna").submit(function(e) {
		e.preventDefault();
		$("#log_simpan").html("<i class='fas fa-spinner fa-spin'></i> Menyimpan...");
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
					bootstrap.Modal.getInstance(document.getElementById('modal_pengguna')).hide();
				} else {
					toastr.error(res.desc);
				}
				$("#log_simpan").html("<i class='fas fa-check-circle'></i> Simpan");
				$(".btn").attr("disabled", false);
			},
			error: function(jqXHR, namaStatus, errorThrown) {
				$("#log_simpan").html("<i class='fas fa-check-circle'></i> Simpan");
				$(".btn").attr("disabled", false);
				alert('Error get data from ajax');
			}
		});
	});

	function hapus_pengguna(id) {
		event.preventDefault();
		$("#log_id").val(id);
		$("#jdlKonfirm").html("<i class='fas fa-exclamation-circle fa-sm'></i> Konfirmasi hapus data");
		$("#isiKonfirm").html("Yakin ingin menghapus data ini ?");
		var myModal = new bootstrap.Modal(document.getElementById('frmKonfirm'));
		myModal.show();
	}

	function ubah_pengguna(id) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "cari",
			data: "log_id=" + id,
			dataType: "json",
			success: function(data) {
				$("#log_id").val(data.log_id);
				$("#log_nama").val(data.log_nama);
				$("#log_email").val(data.log_email);
				$("#log_user").val(data.log_user);
				$("#log_level").val(data.log_level);
				$("#log_aktif").val(data.log_aktif);
				$(".inputan").attr("disabled", false);
				var myModal = new bootstrap.Modal(document.getElementById('modal_pengguna'));
				myModal.show();
				return false;
			}
		});
	}

	function reset_form() {
		$("#log_id").val(0);
		$("#frm_pengguna")[0].reset();
		$("#log_kry_id").trigger('change');
	}

	$("#yaKonfirm").click(function() {
		var id = $("#log_id").val();

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
				alert('Error get data from ajax');
			}
		});
	});

	$(document).on('change', '.toggle-status', function() {
		const id = $(this).data('id');
		const status = $(this).is(':checked') ? 1 : 0;

		$.ajax({
			url: 'update_status',
			method: 'POST',
			data: {
				id: id,
				status: status
			},
			success: function(response) {
				var res = JSON.parse(response);
				toastr.success(res.desc);
				drawTable();
			},
			error: function() {
				toastr.error(res.desc);
			}
		});
	});

	$('.select2').select2({
		theme: 'bootstrap-5'
	});

	$(document).ready(function() {
		drawTable();
	});
</script>