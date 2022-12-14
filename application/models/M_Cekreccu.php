<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Cekreccu extends CI_MODEL
{
  public function cekReccu($reccu)
  {
    $this->db->select('reccu');
    $this->db->from('paket');
    $this->db->where(['reccu' => $reccu]);
    $query = $this->db->get()->result();
    return $query;
  }
}
