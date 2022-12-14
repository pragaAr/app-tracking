<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Kota', 'Kota');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']    = 'List Kota';
    $data['kdkota']   = $this->Kota->dataKd();
    $data['kota']     = $this->Kota->getData();

    $this->form_validation->set_rules('kdkota', 'Kd Kota', 'required');
    $this->form_validation->set_rules('namakota', 'Nama Kota', 'trim|required|strtolower');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('main/kota', $data);
      $this->load->view('template/footer');
    } else {
      $this->Kota->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('kota');
    }
  }

  public function getId()
  {
    $id = $this->input->post('id_kota');
    $data = $this->Kota->getDataId($id);

    echo json_encode($data);
  }

  public function update()
  {
    $id = $this->input->post('idkota');
    $this->Kota->editData($id);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('kota');
  }

  public function delete($id)
  {
    $this->Kota->deleteData($id);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('kota');
  }
}
