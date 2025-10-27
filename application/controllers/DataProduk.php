<?php

use Dompdf\Dompdf;
use Dompdf\Options;

// This Application made with love by Wegi Zulianda
// author: wegizulianda@gmail.com
// company: https://webdeveloperpku.com

defined('BASEPATH') or exit('No direct script access allowed');

class DataProduk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		$this->load->model('Model_Produk', 'data_produk');
		$this->load->model('Model_KategoriProduk', 'kategori_produk');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function tampil()
	{
		$page = [
			'page' => 'Data Produk',
			'kategori' => $this->kategori_produk->get_kategori_produk(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $page);
		$this->load->view('data_produk', $page);
		$this->load->view('background_bawah');
	}

	public function ajax_list_data_produk()
	{
		$list = $this->data_produk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $data_produk) {
			$aksi = "<a href='#' class='btn btn-success btn-xs' onClick='lihatBatch(" . $data_produk->prd_id . ")' title='Lihat Batch'><i class='fa fa-layer-group'></i></a>&nbsp;<a href='#' class='btn btn-primary btn-xs' onClick='ubah_data_produk(" . $data_produk->prd_id . ")' title='Ubah Data'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' class='btn btn-danger btn-xs' onClick='hapus_data_produk(" . $data_produk->prd_id . ")' title='Hapus Data'><i class='fa fa-trash-alt'></i></a>";

			if ($data_produk->prd_stok <= $data_produk->prd_stok_minimal && $data_produk->prd_stok > 0) {
				$stok = "<span class='badge badge-warning py-1 px-2'> <i class='fas fa-exclamation-triangle'></i> {$data_produk->prd_stok} {$data_produk->sb_nama}</span>";
			} else if ($data_produk->prd_stok > $data_produk->prd_stok_minimal) {
				$stok = "<span class='badge badge-success py-1 px-2'> {$data_produk->prd_stok} {$data_produk->sb_nama}</span>";
			} else {
				$stok = "<span class='badge badge-danger py-1 px-2'> 0 Unit</span>";
			}
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<img src= " . base_url("assets/files/data_produk/{$data_produk->prd_foto}") . " width='50px'>";
			$row[] = $data_produk->prd_kode;
			$row[] = $data_produk->prd_nama;
			$row[] = $data_produk->kp_nama;
			$row[] = $data_produk->prd_stok_minimal . ' ' . $data_produk->sb_nama;
			$row[] = $stok;
			$row[] = $aksi;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_produk->count_all(),
			"recordsFiltered" => $this->data_produk->count_filtered(),
			"data" => $data,
			"query" => $this->data_produk->getlastquery(),
		);
		echo json_encode($output);
	}

	public function cari()
	{
		$id = $this->input->post('prd_id');
		$data = $this->data_produk->cari_data_produk($id);
		echo json_encode($data);
	}

	public function cari_batch()
	{
		$id = $this->input->post('prd_id');
		// Ambil batch terkait produk
		$batch = $this->batch->ambil_batch_by_produk($id);
		if ($batch) {
			$result = [
				"success" => true,
				"batch" => $batch
			];
		} else {
			$result = [
				"success" => false,
				"batch" => $batch
			];
		}

		echo json_encode($result);
	}

	public function simpan()
	{
		$id = $this->input->post('prd_id');
		$data = $this->input->post();
		$data['updated_at'] = date('Y-m-d H:i:s');

		$nmfile = "prd_" . strtolower($data['prd_nama']);

		$config['upload_path'] = 'assets/files/data_produk/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name'] = $nmfile;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($_FILES['prd_foto']['name']) {
			if (!$this->upload->do_upload('prd_foto')) {
				$error = array('error' => $this->upload->display_errors());
				$resp['errorFoto'] = $error;
			} else {
				$data['prd_foto'] = $this->upload->data('file_name');
			}
		}

		if ($id == 0) {
			$insert = $this->data_produk->simpan("data_produk", $data);
		} else {
			$insert = $this->data_produk->update("data_produk", array('prd_id' => $id), $data);
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
		$delete = $this->data_produk->delete('data_produk', 'prd_id', $id);
		if ($delete) {
			$resp['success'] = true;
			$resp['desc'] = "Berhasil menghapus data";
		} else {
			$resp['success'] = false;
			$resp['desc'] = "Gagal menghapus data";
		}
		echo json_encode($resp);
	}

	public function pdf()
	{
		$data['data'] = $this->data_produk->get_data_produk();

		// $this->load->view('pdf_pembelian', $data);
		// Render HTML ke view
		$html = $this->load->view('pdf_produk', $data, TRUE);

		// Set Dompdf options
		$options = new Options();
		$options->set('isRemoteEnabled', true); // biar bisa load image via http/https
		$dompdf = new Dompdf($options);

		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Nama file PDF
		$filename = "Data_Produk.pdf";

		ob_clean(); // penting
		// Download
		$dompdf->stream($filename, array("Attachment" => true));
		exit();
	}
}
