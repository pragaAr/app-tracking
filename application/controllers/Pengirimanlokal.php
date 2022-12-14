<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengirimanlokal extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Delivlokal', 'Delivlokal');
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Penjualanlokal', 'Penlok');
    $this->load->model('M_User', 'User');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin' && $this->session->userdata('role_access') != 'admcab') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']    = 'List Pengiriman Lokal';
    $data['deliv']    = $this->Delivlokal->getData();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/deliv-lokal', $data);
    $this->load->view('template/footer');
  }

  public function adddeliv()
  {
    $data['title']      = 'Tambah Data Pengiriman Lokal';
    $usercab            = $this->session->userdata('usercab_id');
    $userkota           = $this->session->userdata('userkota_id');
    $data['kota']       = $this->Kota->getByUserKota($userkota);
    $data['penlok']     = $this->Penlok->getDataReccuNotSend($userkota);
    $data['kurir']      = $this->User->getKurirByKota($userkota);
    $data['kdkirim']    = $this->Delivlokal->getKd($usercab);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/add-delivlokal', $data);
  }

  public function getDataPaketId()
  {
    $id   = $this->input->post('id_paket');
    $data = $this->Penlok->getDataId($id);

    echo json_encode($data);
  }

  public function cart()
  {
    $this->load->view('delivery/cart-delivlokal');
  }

  public function cartupdate()
  {
    $this->load->view('delivery/cart-update-delivlokal');
  }

  public function proses()
  {
    $userid     = $this->session->userdata('id_user');
    $usercab    = $this->session->userdata('usercab_id');
    $kuririd    = $this->input->post('kuririd');
    $jmlReccu   = count($this->input->post('reccu_hidden'));

    // $datakurir  = $this->User->getDataKurir($kuririd);
    // $namakurir  = $datakurir->nama_user;

    $data  = [
      'kd_delivlokal'   => $this->input->post('kddelivlokal'),
      'cab_id'          => $usercab,
      'kurir_id'        => $kuririd,
      'total_reccu'     => $jmlReccu,
      'createdAt'       => date('Y-m-d H:i:s'),
      'user_id'         => $userid
    ];

    $detail = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($detail, ['reccu'   => $this->input->post('reccu_hidden')[$i]]);
      $detail[$i]['kd_delivlokal']   = $this->input->post('kddelivlokal');
      $detail[$i]['status']          = $this->input->post('status_hidden')[$i];
    }

    $track = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($track, ['reccu'    => $this->input->post('reccu_hidden')[$j]]);
      $track[$j]['cab_id']           = $usercab;
      $track[$j]['status']           = $this->input->post('status_hidden')[$j];
      $track[$j]['actions']          = 6;
      $track[$j]['createdAt']        = date('Y-m-d H:i:s');
      $track[$j]['user_id']          = $userid;
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'   => $this->input->post('reccu_hidden')[$k]]);
      $paket[$k]['lokalSentAt']      = date('Y-m-d H:i:s');
    }

    $this->Delivlokal->addData($data, $detail, $track, $paket);
    $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
    redirect('pengirimanlokal');
  }

  public function detail($kd)
  {
    $data['title']    = 'Detail Pengiriman Lokal';
    $data['deliv']    = $this->Delivlokal->getDataKd($kd);
    $data['detail']   = $this->Delivlokal->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/detail-lokal', $data);
    $this->load->view('template/footer');
  }

  public function updatedeliv($kd)
  {
    $data['title']    = 'Update Pengiriman Lokal';
    $usercab          = $this->session->userdata('usercab_id');
    $userkota         = $this->session->userdata('userkota_id');
    $data['kota']     = $this->Kota->getByUserKota($userkota);
    $data['penlok']   = $this->Penlok->getDataReccuLokal($userkota);
    $data['kurir']    = $this->User->getKurirByKota($userkota);
    $data['deliv']    = $this->Delivlokal->getDataKd($kd);
    $data['detail']   = $this->Delivlokal->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/update-deliv-lokal', $data);
  }

  public function prosesupdate()
  {
    $userid         = $this->session->userdata('id_user');
    $usercab        = $this->session->userdata('usercab_id');
    $kd             = $this->input->post('kddelivlokal');
    $kuririd        = $this->input->post('kuririd');
    $created        = $this->input->post('createdat');
    $reccu          = $this->input->post('reccu_hidden');
    $reccuold       = $this->input->post('reccuold_hidden');
    $status         = $this->input->post('status_hidden');
    $jmlReccu       = count($this->input->post('reccu_hidden'));
    $jmlReccuOld    = count($this->input->post('reccuold_hidden'));

    // $datakurir      = $this->User->getDataKurir($kuririd);
    // $namakurir      = $datakurir->nama_user;

    $data  = [
      'cab_id'        => $usercab,
      'kurir_id'      => $kuririd,
      'total_reccu'   => $jmlReccu,
      'createdAt'     => date('Y-m-d H:i:s', strtotime($created)),
      'user_id'       => $userid
    ];

    $detail = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($detail, ['reccu'  => $reccu[$i]]);
      $detail[$i]['kd_delivlokal']  = $kd;
      $detail[$i]['status']         = $status[$i];
    }

    $track = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($track, ['reccu'    => $reccu[$j]]);
      $track[$j]['cab_id']           = $usercab;
      $track[$j]['status']           = $status[$j];
      $track[$j]['actions']          = 6;
      $track[$j]['createdAt']        = date('Y-m-d H:i:s', strtotime($created));
      $track[$j]['user_id']          = $userid;
    }

    $trackUpdate = [];

    for ($k = 0; $k < $jmlReccuOld; $k++) {
      array_push($trackUpdate, ['reccu'    => $reccuold[$k]]);
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'    => $reccu[$k]]);
      $paket[$k]['lokalSentAt']      = date('Y-m-d H:i:s', strtotime($created));
    }

    $paketUpdate = [];

    for ($k = 0; $k < $jmlReccuOld; $k++) {
      array_push($paketUpdate, ['reccu'   => $reccuold[$k]]);
      $paketUpdate[$k]['lokalSentAt']     = null;
    }

    $this->Delivlokal->updateDataDeliv($kd, $data, $detail);
    $this->Delivlokal->updateDataPaketTrack($paket, $paketUpdate, $track, $trackUpdate);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('pengirimanlokal');
  }

  public function delete($kd)
  {
    $this->Delivlokal->delete($kd);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('pengirimanlokal');
  }
}
