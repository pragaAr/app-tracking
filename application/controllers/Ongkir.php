<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Kota', 'Kota');
    $this->load->model('M_Ongkir', 'Ongkir');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']        = 'List Ongkir';
    $data['kotaasal']     = $this->Kota->getData();
    $data['kotatujuan']   = $this->Kota->getData();
    $data['asal']         = $this->Kota->getData();
    $data['tujuan']       = $this->Kota->getData();
    $data['ongkir']       = $this->Ongkir->getData();

    $this->form_validation->set_rules('kotaasal', 'Kota Asal', 'required');
    $this->form_validation->set_rules('kotatujuan', 'Kota Tujuan', 'required');
    $this->form_validation->set_rules('minimal', 'Minimal', 'trim|required');
    $this->form_validation->set_rules('perkg', 'Per Kg', 'trim|required');
    $this->form_validation->set_rules('estimasi', 'Estimasi', 'trim|required|strtolower');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('main/ongkir', $data);
      $this->load->view('template/footer');
    } else {
      $this->Ongkir->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('ongkir');
    }
  }

  public function getId()
  {
    $id = $this->input->post('id_ongkir');
    $data = $this->Ongkir->getDataId($id);

    echo json_encode($data);
  }

  public function update()
  {
    $id = $this->input->post('idongkir');
    $this->Ongkir->editData($id);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('ongkir');
  }

  public function delete($id)
  {
    $this->Ongkir->deleteData($id);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('ongkir');
  }
}
