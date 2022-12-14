<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Cekreccu', 'Cek');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function cekDataReccu()
  {
    $reccu  = $this->input->post('reccu');
    $data   = $this->Cek->cekReccu($reccu);

    echo json_encode($data);
  }
}
