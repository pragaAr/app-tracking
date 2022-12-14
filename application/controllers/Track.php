<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Track extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Track', 'Track');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']  = 'Tracking Reccu';

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('track', $data);
  }

  public function getReccu()
  {
    $reccu  = $this->input->post('reccu');
    $data   = $this->Track->getDataReccu($reccu);

    echo json_encode($data);
  }
}
