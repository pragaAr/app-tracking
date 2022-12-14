<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengirimancabang extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Delivcabang', 'Delivcab');
    $this->load->model('M_Cabang', 'Cabang');
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Penjualancabang', 'Pencab');
    $this->load->model('M_User', 'User');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin' && $this->session->userdata('role_access') != 'admcab' && $this->session->userdata('role_access') != 'mandor') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']    = 'List Pengiriman Cabang';
    $data['role']     = $this->session->userdata('role_access') == 'admcab';
    $data['deliv']    = $this->Delivcab->getData();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/deliv-cabang', $data);
    $this->load->view('template/footer');
  }

  public function adddeliv()
  {
    $data['title']      = 'Tambah Data Pengiriman Cabang';
    $usercab            = $this->session->userdata('usercab_id');
    $userkota           = $this->session->userdata('userkota_id');
    $data['kota']       = $this->Kota->getData();
    $data['pencab']     = $this->Pencab->getDataTujuanLain($userkota);
    $data['kdkirim']    = $this->Delivcab->getKd($usercab);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/add-delivcab', $data);
  }

  public function getDataPaketId()
  {
    $id   = $this->input->post('id_paket');
    $data = $this->Pencab->getDataId($id);

    echo json_encode($data);
  }

  public function getReccu()
  {
    $reccu   = $this->input->post('reccu');
    $data = $this->Pencab->getDataRowReccu($reccu);

    echo json_encode($data);
  }

  public function cart()
  {
    $this->load->view('delivery/cart-delivcab');
  }

  public function cartupdate()
  {
    $this->load->view('delivery/cart-update-delivcab');
  }

  public function proses()
  {
    $userid     = $this->session->userdata('id_user');
    $userkota   = $this->session->userdata('userkota_id');
    $usercab    = $this->session->userdata('usercab_id');
    $jmlReccu   = count($this->input->post('reccu_hidden'));

    $data  = [
      'kd_delivcab'     => $this->input->post('kddelivcab'),
      'kotaasal_id'     => $userkota,
      'kotatujuan_id'   => $this->input->post('tujuan'),
      'platno'          => $this->input->post('platno'),
      'total_reccu'     => $jmlReccu,
      'createdAt'       => date('Y-m-d H:i:s'),
      'user_id'         => $userid
    ];

    $detail = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($detail, ['reccu'  => $this->input->post('reccu_hidden')[$i]]);
      $detail[$i]['kd_delivcab']    = $this->input->post('kddelivcab');
      $detail[$i]['status']         = $this->input->post('status_hidden')[$i];
    }

    $track = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($track, ['reccu'    => $this->input->post('reccu_hidden')[$j]]);
      $track[$j]['cab_id']           = $usercab;
      $track[$j]['status']           = $this->input->post('status_hidden')[$j];
      $track[$j]['actions']          = 4;
      $track[$j]['createdAt']        = date('Y-m-d H:i:s');
      $track[$j]['user_id']          = $userid;
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'   => $this->input->post('reccu_hidden')[$k]]);
      $paket[$k]['cabSentAt']       = date('Y-m-d H:i:s');
    }

    $this->Delivcab->addData($data, $detail, $track, $paket);
    $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
    redirect('pengirimancabang');
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

    $updatedetail  = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($updatedetail, ['reccu'  => $this->input->post('reccu_hidden')[$j]]);
      $updatedetail[$j]['status']         = "paket telah tiba di pool " . " - " . $namakota->nama_kota;
      $updatedetail[$j]['sentAt']         = date('Y-m-d H:i:s');
    }

    $updatepaket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($updatepaket, ['reccu'   => $this->input->post('reccu_hidden')[$k]]);
      $updatepaket[$k]['receivedAt']      = date('Y-m-d H:i:s');
    }

    $this->Delivagen->updateDeliv($kd, $track, $updatedetail, $updatepaket);
    $this->session->set_flashdata('updated', 'Status berhasil diubah!');
    redirect('pengirimanagen');
  }

  public function updatedeliv($kd)
  {
    $data['title']    = 'Update Pengiriman Cabang';
    $userkota         = $this->session->userdata('userkota_id');
    $data['kota']     = $this->Kota->getData();
    $data['pencab']   = $this->Pencab->getDataReccuTujuanLain($userkota);
    $data['deliv']    = $this->Delivcab->getDataKd($kd);
    $data['detail']   = $this->Delivcab->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/update-deliv-cabang', $data);
  }

  public function prosesupdate()
  {
    $userid             = $this->session->userdata('id_user');
    $userkota           = $this->session->userdata('userkota_id');
    $usercab            = $this->session->userdata('usercab_id');
    $kd                 = $this->input->post('kddelivcab');
    $jmlReccu           = count($this->input->post('reccu_hidden'));
    $jmlReccuOld        = count($this->input->post('reccuold_hidden'));

    $data  = [
      'kotaasal_id'     => $userkota,
      'kotatujuan_id'   => $this->input->post('tujuan'),
      'platno'          => $this->input->post('platno'),
      'total_reccu'     => $jmlReccu,
      'createdAt'       => date('Y-m-d H:i:s', strtotime($this->input->post('createdat'))),
      'user_id'         => $userid
    ];

    $detail = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($detail, ['reccu'  => $this->input->post('reccu_hidden')[$i]]);
      $detail[$i]['kd_delivcab']    = $kd;
      $detail[$i]['status']         = $this->input->post('status_hidden')[$i];
    }

    $track = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($track, ['reccu'    => $this->input->post('reccu_hidden')[$j]]);
      $track[$j]['cab_id']           = $usercab;
      $track[$j]['status']           = $this->input->post('status_hidden')[$j];
      $track[$j]['actions']          = 4;
      $track[$j]['createdAt']        = date('Y-m-d H:i:s', strtotime($this->input->post('createdat')));
      $track[$j]['user_id']          = $userid;
    }

    $trackUpdate = [];

    for ($k = 0; $k < $jmlReccuOld; $k++) {
      array_push($trackUpdate, ['reccu'    => $this->input->post('reccuold_hidden')[$k]]);
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'    => $this->input->post('reccu_hidden')[$k]]);
      $paket[$k]['cabSentAt']        = date('Y-m-d H:i:s', strtotime($this->input->post('createdat')));
    }

    $paketUpdate = [];

    for ($k = 0; $k < $jmlReccuOld; $k++) {
      array_push($paketUpdate, ['reccu'    => $this->input->post('reccuold_hidden')[$k]]);
      $paketUpdate[$k]['cabSentAt']        = null;
    }

    $this->Delivcab->updateDataDeliv($kd, $data, $detail);
    $this->Delivcab->updateDataPaketTrack($paket, $paketUpdate, $track, $trackUpdate);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('pengirimancabang');
  }

  public function detail($kd)
  {
    $data['title']    = 'Detail Pengiriman Cabang';
    $data['deliv']    = $this->Delivcab->getDataKd($kd);
    $data['detail']   = $this->Delivcab->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/detail-cabang', $data);
    $this->load->view('template/footer');
  }

  public function delete($kd)
  {
    $this->Delivcab->delete($kd);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('pengirimancabang');
  }
}
