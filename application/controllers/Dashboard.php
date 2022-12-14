<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
			redirect('auth');
		}
	}

	public function index()
	{
		$data['title']		= 'Dashboard';

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('main/dashboard', $data);
		$this->load->view('template/footer');
	}
}
