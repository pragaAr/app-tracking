<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Cabang', 'Cabang');
    $this->load->model('M_Kota', 'Kota');
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
    $data['title']    = 'List User';
    $data['kota']     = $this->Kota->getData();
    $data['kotaedit'] = $this->Kota->getData();
    $data['cab']      = $this->Cabang->getData();
    $data['cabedit']  = $this->Cabang->getData();
    $data['user']     = $this->User->getData();

    $this->form_validation->set_rules('nama', 'Nama User', 'trim|required');
    $this->form_validation->set_rules('cabid', 'Asal', 'required');
    $this->form_validation->set_rules('kotaid', 'Kota', 'required');
    $this->form_validation->set_rules('uname', 'Username', 'trim|required|strtolower');
    $this->form_validation->set_rules('pass', 'Password', 'required');
    $this->form_validation->set_rules('role', 'Role Access', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('template/header', $data);
      $this->load->view('template/navbar');
      $this->load->view('template/sidebar');
      $this->load->view('main/user', $data);
      $this->load->view('template/footer');
    } else {
      $this->User->addData();
      $this->session->set_flashdata('inserted', 'Data berhasil ditambahkan!');
      redirect('user');
    }
  }

  public function getId()
  {
    $id = $this->input->post('id_user');
    $data = $this->User->getDataId($id);

    echo json_encode($data);
  }

  public function update()
  {
    $id = $this->input->post('iduser');
    $this->User->editData($id);
    $this->session->set_flashdata('updated', 'Data berhasil diubah!');
    redirect('user');
  }

  public function delete($id)
  {
    $this->User->deleteData($id);
    $this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
    redirect('user');
  }
}
