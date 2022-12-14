<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_MODEL
{
  public function cekLogin()
  {
    $uname  = set_value('username');
    $pass   = set_value('pass');

    $result = $this->db
      ->where('username', $uname)
      ->where('pass', md5($pass))
      ->limit(1)
      ->get('user');

    if ($result->num_rows() > 0) {
      return $result->row();
    } else {
      return false;
    }
  }

  public function register()
  {
    $kotaid       = $this->input->post('kota');
    $cabkd        = $this->input->post('cabang');
    $nama         = $this->input->post('nama');
    $uname        = $this->input->post('username');
    $pass         = md5($this->input->post('pass'));
    $role         = $this->input->post('role');
    $createdAt    = date('Y-m-d H:i:s');

    $data = array(
      'userkota_id'   => $kotaid,
      'usercab_kd'    => $cabkd,
      'nama_user'     => $nama,
      'username'      => $uname,
      'pass'          => $pass,
      'role_access'   => $role,
      'createdAt'     => $createdAt
    );

    $this->db->insert('user', $data);
  }
}
