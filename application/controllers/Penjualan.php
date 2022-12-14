<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Cabang', 'Cabang');
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Penjualan', 'Penjualan');
    $this->load->model('M_Penjualanlokal', 'Penlok');
    $this->load->model('M_Track', 'Track');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']        = 'List All Penjualan';
    $data['cabasal']      = $this->Cabang->getData();
    $data['cabtujuan']    = $this->Cabang->getDataCabang();
    $data['kotaasal']     = $this->Kota->getData();
    $data['kotatujuan']   = $this->Kota->getData();
    $data['penjualan']    = $this->Penjualan->getData();

    $this->form_validation->set_rules('reccu', 'Reccu', 'trim|required');
    $this->form_validation->set_rules('kdpaket', 'Kode Paket', 'trim|required|strtolower');
    $this->form_validation->set_rules('koli', 'Jumlah Paket', 'required');
    $this->form_validation->set_rules('pengirim', 'Nama Pengirim', 'trim|required|strtolower');
    $this->form_validation->set_rules('penerima', 'Nama Penerima', 'trim|required|strtolower');
    $this->form_validation->set_rules('kotaasal', 'Kota Asal', 'required|strtolower');
    $this->form_validation->set_rules('kotatujuan', 'Kota Tujuan', 'required|strtolower');
    $this->form_validation->set_rules('cabasal', 'Cabang Asal', 'trim|required|strtolower');
    $this->form_validation->set_rules('cabtujuan', 'Cabang Tujuan', 'trim|required|strtolower');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('penjualan/penjualan', $data);
      $this->load->view('template/footer');
    } else {
      $this->Penjualan->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('penjualan');
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
    $this->Penjualan->editData($noreccu);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('penjualan');
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

  public function delete($reccu)
  {
    $this->Penlok->deleteData($reccu);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('penjualan');
  }
}
