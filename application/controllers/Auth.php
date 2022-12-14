<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Auth', 'Auth');
	}

	public function index()
	{
		$data['title'] = "Login";

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/header', $data);
			$this->load->view('auth/login');
			$this->load->view('auth/footer');
		} else {
			$uname	= $this->input->post('username');
			$pass		= md5($this->input->post('pass'));

			$cek = $this->Auth->cekLogin($uname, $pass);

			if ($cek == false) {
				$this->session->set_flashdata('wrongdata', 'Username atau password salah !');
				redirect('auth');
			} else {
				$this->session->set_userdata('id_user', $cek->id_user);
				$this->session->set_userdata('userkota_id', $cek->userkota_id);
				$this->session->set_userdata('usercab_id', $cek->usercab_id);
				$this->session->set_userdata('nama_user', $cek->nama_user);
				$this->session->set_userdata('username', $cek->username);
				$this->session->set_userdata('role_access', $cek->role_access);

				if ($cek->role_access == 'kurir') {
					$this->session->set_flashdata('userlogin', 'Login Berhasil');
					redirect('kurir');
				} else {
					$this->session->set_flashdata('userlogin', 'Selamat Datang ' . ucwords($this->session->userdata('nama_user')));
					redirect('dashboard');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('userkota_id');
		$this->session->unset_userdata('usercab_kd');
		$this->session->unset_userdata('nama_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_access');
		$this->session->set_flashdata('userlogout', 'Sampai jumpa kembali!');
		redirect('auth');
	}
}
