<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This Application made with love by Wegi Zulianda
// author: wegizulianda@gmail.com
// company: https://webdeveloperpku.com

class Pengguna extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		if ($this->session->userdata("level") > 3) {
			redirect(base_url("Dashboard"));
		}
		$this->load->library('upload');
		$this->load->model('Model_Login', 'pengguna');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tampil()
	{
		$page = [
			'page' => 'Manajemen User',
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $page);
		$this->load->view('pengguna', $page);
		$this->load->view('background_bawah');
	}

	public function ajax_list_pengguna()
	{
		$list = $this->pengguna->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pengguna) {
			$checked = $pengguna->log_aktif == '1' ? 'checked' : '';
			$statusText = $pengguna->log_aktif == '1' ? 'Aktif' : 'Nonaktif';

			$hapus = " <a href='#' class='btn btn-danger btn-xs' onClick='hapus_pengguna(" . $pengguna->log_id . ")' title='Hapus data Pengguna'><i class='fa fa-trash-alt'></i></a>";
			if ($this->session->userdata("level") == 2) {
				if ($pengguna->log_level == 2) {
					$hapus = "";
				}
			}
			$no++;
			$level = "";
			switch ($pengguna->log_level) {
				case 1:
					$level = "<span class='badge badge-info py-1 px-2'><i class='fas fa-user-shield'></i> Super Admin</span>";
					break;
				case 2:
					$level = "<span class='badge badge-info py-1 px-2'><i class='fas fa-user-edit'></i> Admin</span>";
					break;
				case 3:
					$level = "<span class='badge badge-info py-1 px-2'><i class='fas fa-eye'></i> Investor</span>";
					break;
			}
			$row = array();
			$row[] = $no;
			$row[] = $pengguna->log_nama;
			$row[] = $pengguna->log_email;
			$row[] = $pengguna->log_user;
			$row[] = $level;
			$row[] = "
					<label class='switch'>
						<input type='checkbox' class='toggle-status' data-id='{$pengguna->log_id}' {$checked}>
						<span class='slider round'></span>
					</label>
					<span class='status-label'>{$statusText}</span>
				";
			$row[] = "<a href='#' class='btn btn-primary btn-xs' onClick='ubah_pengguna(" . $pengguna->log_id . ")' title='Ubah data Pengguna'><i class='fa fa-edit'></i></a> {$hapus}";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengguna->count_all(),
			"recordsFiltered" => $this->pengguna->count_filtered(),
			"data" => $data,
			"query" => $this->pengguna->getlastquery(),
		);
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('log_id');
		$data = $this->pengguna->cari_pengguna($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('log_id');
		$pass = $this->input->post('log_pass');
		$data = $this->input->post();

		if (!empty($pass)) {
			$data['log_pass'] = md5($pass);
		}

		if ($id == 0) {
			if (empty($pass)) {
				$data['log_pass'] = md5("wdp-user123");
			}
			$insert = $this->pengguna->simpan("data_user", $data);
		} else {
			$insert = $this->pengguna->update("data_user", array('log_id' => $id), $data);
		}

		$error = $this->db->error();
		if (!empty($error)) {
			$err = $error['message'];
		} else {
			$err = "";
		}

		if ($insert) {
			$resp['success'] = true;
			$resp['desc'] = "Berhasil menyimpan data";
		} else {
			$resp['success'] = false;
			$resp['desc'] = "Gagal menyimpan data";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}

	public function hapus($id)
	{
		try {
			$delete = $this->pengguna->delete('data_user', 'log_id', $id);
			if ($delete) {
				$resp['success'] = true;
				$resp['desc'] = "Berhasil menghapus data";
			} else {
				$resp['success'] = false;
				$resp['desc'] = "Pengguna tidak bisa dihapus";
				$resp['err'] = "Data memiliki relasi dengan tabel lain";
			}
		} catch (Exception $e) {
			$resp['success'] = false;
			$resp['desc'] = "Terjadi kesalahan saat menghapus data";
			$resp['err'] = $e->getMessage();
		}

		echo json_encode($resp);
	}

	public function update_status()
	{
		$data = $this->input->post();

		$update = $this->pengguna->update("data_user", array('log_id' => $data['id']), array('log_aktif' => $data['status']));

		$error = $this->db->error();
		if (!empty($error)) {
			$err = $error['message'];
		} else {
			$err = "";
		}
		if ($update) {
			$resp['success'] = true;
			$resp['desc'] = "Status User berhasil diupdate";
		} else {
			$resp['success'] = false;
			$resp['desc'] = "Ada kesalahan dalam penyimpanan!";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}
}
