<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengirimanagen extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Delivagen', 'Delivagen');
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Penjualanagen', 'Penagen');
    $this->load->model('M_User', 'User');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $data['title']    = 'List Pengiriman Agen';
    $data['deliv']    = $this->Delivagen->getData();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/deliv-agen', $data);
    $this->load->view('template/footer');
  }

  public function adddeliv()
  {
    $data['title']      = 'Tambah Data Pengiriman Agen';
    $usercab            = $this->session->userdata('usercab_id');
    $userkota           = $this->session->userdata('userkota_id');
    $data['kota']       = $this->Kota->getByUserKota($userkota);
    $data['penagen']    = $this->Penagen->getDataReccuNotSend($usercab);
    $data['kurir']      = $this->User->getKurirByKota($userkota);
    $data['kdkirim']    = $this->Delivagen->getKd($usercab);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/add-delivagen', $data);
  }

  public function getDataPaketId()
  {
    $id   = $this->input->post('id_paket');
    $data = $this->Penagen->getDataId($id);

    echo json_encode($data);
  }

  public function cart()
  {
    $this->load->view('delivery/cart-delivagen');
  }

  public function cartupdate()
  {
    $this->load->view('delivery/cart-update-delivagen');
  }

  public function proses()
  {
    $userid     = $this->session->userdata('id_user');
    $usercab    = $this->session->userdata('usercab_id');
    $jmlReccu   = count($this->input->post('reccu_hidden'));

    $data  = [
      'kd_delivagen'  => $this->input->post('kddelivagen'),
      'cab_id'        => $usercab,
      'kurir_id'      => $this->input->post('kuririd'),
      'total_reccu'   => $jmlReccu,
      'createdAt'     => date('Y-m-d H:i:s'),
      'user_id'       => $userid
    ];

    $detail = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($detail, ['reccu'   => $this->input->post('reccu_hidden')[$i]]);
      $detail[$i]['kd_delivagen']    = $this->input->post('kddelivagen');
      $detail[$i]['status']          = $this->input->post('status_hidden')[$i];
    }

    $track = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($track, ['reccu'    => $this->input->post('reccu_hidden')[$j]]);
      $track[$j]['cab_id']           = $usercab;
      $track[$j]['status']           = $this->input->post('status_hidden')[$j];
      $track[$j]['actions']          = 2;
      $track[$j]['createdAt']        = date('Y-m-d H:i:s');
      $track[$j]['user_id']          = $userid;
    }

    $paket = [];

    for ($k = 0; $k < $jmlReccu; $k++) {
      array_push($paket, ['reccu'   => $this->input->post('reccu_hidden')[$k]]);
      $paket[$k]['agenSentAt']      = date('Y-m-d H:i:s');;
    }

    $this->Delivagen->addData($data, $detail, $track, $paket);
    $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
    redirect('pengirimanagen');
  }

  public function detail($kd)
  {
    $data['title']    = 'Detail Pengiriman Agen';
    $data['deliv']    = $this->Delivagen->getDataKd($kd);
    $data['detail']   = $this->Delivagen->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/detail-agen', $data);
    $this->load->view('template/footer');
  }

  public function listdetail()
  {
    $kd     = $this->input->post('kd_delivagen');
    $data   = $this->Delivagen->getDetailKd($kd);

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
      $track[$i]['actions']         = 3;
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
    $data['title']    = 'Update Pengiriman Agen';
    $usercab          = $this->session->userdata('usercab_id');
    $userkota         = $this->session->userdata('userkota_id');
    $data['kota']     = $this->Kota->getByUserKota($userkota);
    $data['penagen']  = $this->Penagen->getDataReccuAgen($usercab);
    $data['kurir']    = $this->User->getKurirByKota($userkota);
    $data['deliv']    = $this->Delivagen->getDataKd($kd);
    $data['detail']   = $this->Delivagen->getDetailKd($kd);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('delivery/update-deliv-agen', $data);
  }

  public function prosesupdate()
  {
    $userid             = $this->session->userdata('id_user');
    $usercab            = $this->session->userdata('usercab_id');
    $kd                 = $this->input->post('kddelivagen');
    $jmlReccu           = count($this->input->post('reccu_hidden'));
    $jmlReccuOld        = count($this->input->post('reccuold_hidden'));

    $data  = [
      'cab_id'        => $usercab,
      'kurir_id'      => $this->input->post('kuririd'),
      'total_reccu'   => $jmlReccu,
      'createdAt'     => date('Y-m-d H:i:s', strtotime($this->input->post('createdat'))),
      'user_id'       => $userid
    ];

    $detail = [];

    for ($i = 0; $i < $jmlReccu; $i++) {
      array_push($detail, ['reccu'  => $this->input->post('reccu_hidden')[$i]]);
      $detail[$i]['kd_delivagen']   = $kd;
      $detail[$i]['status']         = $this->input->post('status_hidden')[$i];
    }

    $track = [];

    for ($j = 0; $j < $jmlReccu; $j++) {
      array_push($track, ['reccu'    => $this->input->post('reccu_hidden')[$j]]);
      $track[$j]['cab_id']           = $usercab;
      $track[$j]['status']           = $this->input->post('status_hidden')[$j];
      $track[$j]['actions']          = 2;
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
      $paket[$k]['agenSentAt']        = date('Y-m-d H:i:s', strtotime($this->input->post('createdat')));
    }

    $paketUpdate = [];

    for ($k = 0; $k < $jmlReccuOld; $k++) {
      array_push($paketUpdate, ['reccu'   => $this->input->post('reccuold_hidden')[$k]]);
      $paketUpdate[$k]['agenSentAt']      = null;
    }

    $this->Delivagen->updateDataDeliv($kd, $data, $detail);
    $this->Delivagen->updateDataPaketTrack($paket, $paketUpdate, $track, $trackUpdate);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('pengirimanagen');
  }

  public function delete($kd)
  {
    $this->Delivagen->delete($kd);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('pengirimanagen');
  }
}
