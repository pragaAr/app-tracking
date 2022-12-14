<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_User extends CI_MODEL
{
  public function getData()
  {
    $userkota = $this->session->userdata('userkota_id');
    $userrole = $this->session->userdata('role_access');

    if ($userrole == 'superadmin') {
      $this->db->select('user.id_user, user.userkota_id, user.usercab_id, user.nama_user, user.username, user.role_access, kota.id_kota, kota.nama_kota, cabang.id_cab, cabang.nama_cab');
      $this->db->from('user');
      $this->db->join('kota', 'kota.id_kota = user.userkota_id');
      $this->db->join('cabang', 'cabang.id_cab = user.usercab_id');
      $query = $this->db->get()->result();
      return $query;
    } else {
      $this->db->select('user.id_user, user.userkota_id, user.usercab_id, user.nama_user, user.username, user.role_access, kota.id_kota, kota.nama_kota, cabang.id_cab, cabang.nama_cab');
      $this->db->from('user');
      $this->db->join('kota', 'kota.id_kota = user.userkota_id');
      $this->db->join('cabang', 'cabang.id_cab = user.usercab_id');
      $this->db->where('user.userkota_id', $userkota);
      $this->db->where('user.role_access !=', 'superadmin');
      $query = $this->db->get()->result();
      return $query;
    }
  }

  public function getDataId($id)
  {
    $this->db->select('user.id_user, user.userkota_id, user.usercab_id, user.nama_user, user.username, user.role_access, kota.id_kota, kota.nama_kota, cabang.id_cab, cabang.nama_cab');
    $this->db->from('user');
    $this->db->join('kota', 'kota.id_kota = user.userkota_id');
    $this->db->join('cabang', 'cabang.id_cab = user.usercab_id');
    $this->db->where('user.id_user', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getKurirByKota($userkota)
  {
    $this->db->select('id_user, userkota_id, nama_user, role_access');
    $this->db->from('user');
    $this->db->where('userkota_id', $userkota);
    $this->db->where('role_access=', 'kurir');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataKurir($kuririd)
  {
    $this->db->select('nama_user');
    $this->db->from('user');
    $this->db->where('id_user', $kuririd);
    $query = $this->db->get()->row();
    return $query;
  }

  public function addData()
  {
    $kotaid     = $this->input->post('kotaid');
    $cabid      = $this->input->post('cabid');
    $nama       = $this->input->post('nama');
    $username   = $this->input->post('uname');
    $pass       = md5($this->input->post('pass'));
    $role       = $this->input->post('role');
    $time       = date('Y-m-d H:i:s');

    $data = array(
      'userkota_id'   => $kotaid,
      'usercab_id'    => $cabid,
      'nama_user'     => $nama,
      'username'      => $username,
      'pass'          => $pass,
      'role_access'   => $role,
      'createdAt'     => $time,
    );

    $this->db->insert('user', $data);
  }

  public function editData($id)
  {
    $kotaid     = $this->input->post('kotaid');
    $cabid      = $this->input->post('cabid');
    $nama       = $this->input->post('nama');
    $username   = $this->input->post('uname');
    $pass       = md5($this->input->post('pass'));
    $role       = $this->input->post('role');

    $data = array(
      'userkota_id'   => $kotaid,
      'usercab_id'    => $cabid,
      'nama_user'     => $nama,
      'username'      => $username,
      'pass'          => $pass,
      'role_access'   => $role,
    );

    $where = array('id_user' => $id);

    $this->db->update('user', $data, $where);
  }

  public function deleteData($id)
  {
    return $this->db->delete('user', ['id_user' => $id]);
  }
}
