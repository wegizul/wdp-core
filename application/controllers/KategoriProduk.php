<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This Application made with love by Wegi Zulianda
// author: wegizulianda@gmail.com
// company: https://webdeveloperpku.com

class KategoriProduk extends CI_Controller
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
		$this->load->model('Model_KategoriProduk', 'kategori_produk');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tampil()
	{
		$page = [
			'page' => 'Kategori Produk',
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $page);
		$this->load->view('kategori_produk', $page);
		$this->load->view('background_bawah');
	}

	public function ajax_list_kategori_produk()
	{
		$list = $this->kategori_produk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kategori_produk) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kategori_produk->kp_nama;
			$row[] = $kategori_produk->created_at;
			$row[] = "<a href='#' class='btn btn-primary btn-xs' onClick='ubah_kategori_produk(" . $kategori_produk->kp_id . ")' title='Ubah Data'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' class='btn btn-danger btn-xs' onClick='hapus_kategori_produk(" . $kategori_produk->kp_id . ")' title='Hapus Data'><i class='fa fa-trash-alt'></i></a>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kategori_produk->count_all(),
			"recordsFiltered" => $this->kategori_produk->count_filtered(),
			"data" => $data,
			"query" => $this->kategori_produk->getlastquery(),
		);
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('kp_id');
		$data = $this->kategori_produk->cari_kategori_produk($id);
		echo json_encode($data);
	}

	public function simpan()
	{
		$id = $this->input->post('kp_id');
		$data = $this->input->post();

		if ($id == 0) {
			$insert = $this->kategori_produk->simpan("kategori_produk", $data);
		} else {
			$insert = $this->kategori_produk->update("kategori_produk", array('kp_id' => $id), $data);
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
		$delete = $this->kategori_produk->delete('kategori_produk', 'kp_id', $id);
		if ($delete) {
			$resp['success'] = true;
			$resp['desc'] = "Berhasil menghapus data";
		} else {
			$resp['success'] = false;
			$resp['desc'] = "Gagal menghapus data";
		}
		echo json_encode($resp);
	}
}
