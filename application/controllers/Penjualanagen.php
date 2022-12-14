<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualanagen extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Cabang', 'Cabang');
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Penjualanagen', 'Penagen');
    $this->load->model('M_Penjualanlokal', 'Penlok');
    $this->load->model('M_Track', 'Track');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    }
  }

  public function index()
  {
    $usercab              = $this->session->userdata('usercab_id');
    $userkota             = $this->session->userdata('userkota_id');

    $data['title']        = 'List Penjualan Agen';

    $data['asal']         = $this->Kota->getByUserKota($userkota);
    $data['cabtujuan']    = $this->Cabang->getDataCabang();
    $data['kotaasal']     = $this->Kota->getData();
    $data['kotatujuan']   = $this->Kota->getData();
    $data['penagen']      = $this->Penagen->getData($usercab, $userkota);

    $this->form_validation->set_rules('reccu', 'Reccu', 'trim|required');
    $this->form_validation->set_rules('kdpaket', 'Kode Paket', 'trim|required|strtolower');
    $this->form_validation->set_rules('koli', 'Jumlah Paket', 'required');
    $this->form_validation->set_rules('kotaasal', 'Kota Asal', 'required|strtolower');
    $this->form_validation->set_rules('kotatujuan', 'Kota Tujuan', 'required|strtolower');
    $this->form_validation->set_rules('pengirim', 'Nama Pengirim', 'trim|required|strtolower');
    $this->form_validation->set_rules('penerima', 'Nama Penerima', 'trim|required|strtolower');
    $this->form_validation->set_rules('cabtujuan', 'Cabang Tujuan', 'trim|required|strtolower');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('penjualan/agen', $data);
      $this->load->view('template/footer');
    } else {
      $this->Penlok->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('penjualanagen');
    }
  }

  public function getId()
  {
    $id     = $this->input->post('id_paket');
    $data   = $this->Penlok->getDataId($id);

    echo json_encode($data);
  }

  public function update()
  {
    $noreccu = $this->input->post('reccu');
    $this->Penagen->editData($noreccu);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('penjualanagen');
  }

  public function detail($reccu)
  {
    $data['title']        = 'Detail Penjualan Agen';
    $data['penjualan']    = $this->Penlok->getPenjualanByReccu($reccu);
    $data['track']        = $this->Track->getTrackByReccu($reccu);

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar');
    $this->load->view('template/sidebar');
    $this->load->view('penjualan/detail-penjualan', $data);
    $this->load->view('template/footer');
  }
}
