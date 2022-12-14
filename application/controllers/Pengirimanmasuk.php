<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Pengirimanmasuk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Cabang', 'Cabang');
    $this->load->model('M_Delivcabang', 'Delivcab');
    $this->load->model('M_Delivin', 'Delivin');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin' && $this->session->userdata('role_access') != 'admcab' && $this->session->userdata('role_access') != 'mandor') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']   = 'Data Pengiriman Masuk';
    $data['deliv']   = $this->Delivin->getData();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/deliv-in', $data);
    $this->load->view('template/footer');
  }

  public function listdetail()
  {
    $kd     = $this->input->post('kd_delivcab');
    $data   = $this->Delivcab->getDetailKd($kd);

    echo json_encode($data);
  }

  public function update()
  {
    $userid       = $this->session->userdata('id_user');
    $usercab      = $this->session->userdata('usercab_id');
    $userkota     = $this->session->userdata('userkota_id');
    $kd           = $this->input->post('kddeliv');
    $jmlReccu     = count($this->input->post('reccu_hidden'));
    $namakota     = $this->Kota->getByUserKota($userkota);

    $track    = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($track, ['reccu'   => $this->input->post('reccu_hidden')[$i]]);
      $track[$i]['cab_id']          = $usercab;
      $track[$i]['status']          = "paket telah tiba di pool " . " - " . $namakota->nama_kota;
      $track[$i]['actions']         = 5;
      $track[$i]['createdAt']       = date('Y-m-d H:i:s');
      $track[$i]['user_id']         = $userid;
    }

    $detail  = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($detail, ['reccu'  => $this->input->post('reccu_hidden')[$j]]);
      $detail[$j]['status']         = "paket telah tiba di pool " . " - " . $namakota->nama_kota;
      $detail[$j]['sentAt']         = date('Y-m-d H:i:s');
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'   => $this->input->post('reccu_hidden')[$k]]);
      $paket[$k]['receivedAt']      = date('Y-m-d H:i:s');
    }

    $this->Delivin->updateDeliv($kd, $track, $detail, $paket);
    $this->session->set_flashdata('updated', 'Status berhasil diubah!');
    redirect('pengirimanmasuk');
  }

  public function updatedata()
  {
    $userid       = $this->session->userdata('id_user');
    $usercab      = $this->session->userdata('usercab_id');
    $userkota     = $this->session->userdata('userkota_id');
    $kd           = $this->input->post('kddeliv');
    $jmlReccu     = count($this->input->post('reccu_hidden'));
    $namakota     = $this->Kota->getByUserKota($userkota);

    $track    = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($track, ['reccu'   => $this->input->post('reccu_hidden')[$i]]);
      $track[$i]['cab_id']          = $usercab;
      $track[$i]['status']          = "paket telah tiba di pool " . " - " . $namakota->nama_kota;
      $track[$i]['actions']         = 5;
      $track[$i]['createdAt']       = date('Y-m-d H:i:s');
      $track[$i]['user_id']         = $userid;
    }

    $detail  = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($detail, ['reccu'  => $this->input->post('reccu_hidden')[$j]]);
      $detail[$j]['status']         = "paket telah tiba di pool " . " - " . $namakota->nama_kota;
      $detail[$j]['sentAt']         = date('Y-m-d H:i:s');
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'   => $this->input->post('reccu_hidden')[$k]]);
      $paket[$k]['receivedAt']      = date('Y-m-d H:i:s');
    }

    $this->Delivin->updateDeliv($kd, $track, $detail, $paket);
    $this->session->set_flashdata('updated', 'Status berhasil diubah!');
    redirect('pengirimanmasuk');
  }

  public function detail($kd)
  {
    $data['title']    = 'Detail Pengiriman Masuk';
    $data['deliv']    = $this->Delivcab->getDataKd($kd);
    $data['detail']   = $this->Delivcab->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/detail-deliv-in', $data);
    $this->load->view('template/footer');
  }
}
