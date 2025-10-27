<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This Application made with love by Wegi Zulianda
// author: wegizulianda@gmail.com
// company: https://webdeveloperpku.com

class NotFound extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$ba = [
			'judul' => "Under Construction",
			'subjudul' => "under construction",
		];
		$this->load->helper('url');
		$this->load->view('background_atas');
		$this->load->view('maintenance', $ba);
		$this->load->view('background_bawah');
	}
}
