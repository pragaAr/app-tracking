<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Delivlokal', 'Delivlokal');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']  = 'Dashboard';
    $data['kirim']  = $this->Delivlokal->getDelivKurir();
    $data['reccu']  = $this->Delivlokal->getDetailDelivKurir();

    $this->load->view('kurir/header', $data);
    $this->load->view('kurir/navbar');
    $this->load->view('kurir/home', $data);
    $this->load->view('kurir/footer');
  }

  public function detail($kd)
  {
    $data['title']  = 'Detail Delivery';
    $data['kirim']  = $this->Delivlokal->getDetailKd($kd);

    $this->load->view('kurir/header', $data);
    $this->load->view('kurir/navbar');
    $this->load->view('kurir/detail', $data);
    $this->load->view('kurir/footer');
  }

  public function getPaketId()
  {
    $id = $this->input->post('id_delivlokal');
    $data = $this->Delivlokal->getDataDetailtId($id);

    echo json_encode($data);
  }

  public function updatepengiriman()
  {
    $id        = $this->input->post('iddetaillokal');
    $kd        = $this->input->post('kddelivlokal');
    $penerima  = strtolower($this->input->post('penerima'));
    $reccu     = $this->input->post('reccu');

    $this->Delivlokal->updateStats($id, $reccu, $penerima);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('kurir/detail/' . $kd);
  }
}
