<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualancabang extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Penjualanlokal', 'Penlok');
    $this->load->model('M_Penjualancabang', 'Pencab');
    $this->load->model('M_Track', 'Track');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin' && $this->session->userdata('role_access') != 'admcab') {
      redirect('ops');
    }
  }

  public function index()
  {
    $userkota       = $this->session->userdata('userkota_id');
    $usercab        = $this->session->userdata('usercab_id');

    $data['title']  = 'List Penjualan Cabang';

    $data['pencab'] = $this->Pencab->getData($userkota, $usercab);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('penjualan/cabang', $data);
    $this->load->view('template/footer');
  }

  public function detail($reccu)
  {
    $data['title']        = 'Detail Penjualan';
    $data['penjualan']    = $this->Penlok->getPenjualanByReccu($reccu);
    $data['track']        = $this->Track->getTrackByReccu($reccu);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('penjualan/detail-penjualan', $data);
    $this->load->view('template/footer');
  }

  public function getReccu()
  {
    $reccu  = $this->input->post('reccu');
    $data   = $this->Track->getDataReccu($reccu);

    echo json_encode($data);
  }
}
