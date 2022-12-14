<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Cabang', 'Cabang');
    $this->load->model('M_Kota', 'Kota');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashrole', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('role_access') != 'superadmin' && $this->session->userdata('role_access') != 'admcab') {
      redirect('ops');
    }
  }

  public function index()
  {
    $data['title']    = 'List Cabang';
    $data['kdcab']    = $this->Cabang->dataKd();
    $data['cabang']   = $this->Cabang->getData();
    $data['kota']     = $this->Kota->getData();
    $data['edit']     = $this->Kota->getData();

    $this->form_validation->set_rules('kdcab', 'Kd Cabang', 'required');
    $this->form_validation->set_rules('namacab', 'Nama Cabang', 'trim|required|strtolower');
    $this->form_validation->set_rules('jeniscab', 'Jenis Cabang', 'trim|required|strtolower');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('main/cabang', $data);
      $this->load->view('template/footer');
    } else {
      $this->Cabang->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('cabang');
    }
  }

  public function getId()
  {
    $id = $this->input->post('id_cab');
    $data = $this->Cabang->getDataId($id);

    echo json_encode($data);
  }

  public function update()
  {
    $id = $this->input->post('idcab');
    $this->Cabang->editData($id);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('cabang');
  }

  public function delete($id)
  {
    $this->Cabang->deleteData($id);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('cabang');
  }
}
