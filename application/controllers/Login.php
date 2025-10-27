<?php
defined('BASEPATH') or exit('No direct script access allowed');

// This Application made with love by Wegi Zulianda
// author: wegizulianda@gmail.com
// company: https://webdeveloperpku.com

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Login');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		if ($this->session->userdata('id_user')) {
			redirect(base_url('Dashboard'));
		} else {
			$this->session->set_userdata("judul", "Home");
			$this->load->view('login');
		}
	}

	public function proses()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean',  array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean', array('required' => '%s tidak boleh kosong.'));

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Username atau password tidak boleh kosong !');
			redirect('Login');
		} else {
			$usr = $this->input->post('username');
			$psw = $this->input->post('password');
			$cek = $this->Model_Login->cek($usr, $psw);
			if ($cek->num_rows() > 0) {
				foreach ($cek->result() as $user) {
					$sess_data['id_user'] = $user->log_id;
					$sess_data['username'] = $user->log_user;
					$sess_data['password'] = $user->log_pass;
					$sess_data['nama'] = $user->log_nama;
					$sess_data['level'] = $user->log_level;
					$this->session->set_userdata($sess_data);
				}
				$this->session->set_flashdata("message", "Login Berhasil, Hai {$sess_data['nama']}");
				redirect('Dashboard/tampil');
			} else {
				$this->session->set_flashdata('error', 'Username atau password salah !');
				redirect('Login');
			}
		}
	}

	public function ubah_pass()
	{
		$this->form_validation->set_rules('log_pass', 'Password Lama', 'required|trim|xss_clean',  array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('log_passBaru', 'Password Baru', 'required|trim|xss_clean', array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('log_passBaru2', 'Konfirmasi Password Baru', 'required|trim|xss_clean', array('required' => '%s tidak boleh kosong.'));
		if ($this->form_validation->run() == FALSE) {
			$up_data['status'] = FALSE;
			$up_data['pesan'] = validation_errors();
		} else {
			$u = $this->session->userdata("username");
			$p = $this->input->post('log_pass');
			$cek = $this->Model_Login->cek($u, $p, $this->session->userdata("level"));
			if ($cek->num_rows() > 0) {
				$data = array(
					'log_pass' => md5($this->input->post('log_passBaru'))
				);
				$up_pass = $this->Model_Login->update('sys_login', array('log_user' => $u, 'log_pass' => md5($p)), $data);
				if ($up_pass >= 0) {
					$this->session->sess_destroy();
					$up_data['status'] = TRUE;
					$up_data['pesan'] = "Password berhasil diubah";
				}
			} else {
				$up_data['status'] = FALSE;
				$up_data['pesan'] = "Password lama salah";
			}
		}
		echo json_encode($up_data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("Login"));
	}
}
