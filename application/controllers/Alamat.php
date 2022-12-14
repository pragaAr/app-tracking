<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Alamat', 'Alamat');
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
    $data['title']    = 'List Alamat';
    $data['kota']     = $this->Kota->getData();
    $data['kotaedit'] = $this->Kota->getData();
    $data['addr']     = $this->Alamat->getData();

    $this->form_validation->set_rules('kotaid', 'Kota', 'trim|required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|strtolower');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('main/alamat', $data);
      $this->load->view('template/footer');
    } else {
      $this->Alamat->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('alamat');
    }
  }

  public function getId()
  {
    $id = $this->input->post('id_alamat');
    $data = $this->Alamat->getDataId($id);

    echo json_encode($data);
  }

  public function update()
  {
    $id = $this->input->post('idalamat');
    $this->Alamat->editData($id);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('alamat');
  }

  public function delete($id)
  {
    $this->Alamat->deleteData($id);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('alamat');
  }
}
