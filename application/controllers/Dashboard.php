<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This Application made with love by Wegi Zulianda
// author: wegizulianda@gmail.com
// company: https://webdeveloperpku.com

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['id_user'])) {
			redirect(base_url("login"));
		}
		$this->load->model('Model_Produk', 'produk');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		redirect(base_url("Dashboard/tampil"));
	}

	public function tampil()
	{
		$page = [
			'page' => 'Dashboard',
			'produk' => count($this->produk->get_data_produk()),
		];

		$this->load->helper('url');
		$this->load->view('background_atas', $page);
		$this->load->view('dashboard', $page);
		$this->load->view('background_bawah');
	}
}
