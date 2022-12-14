<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Track extends CI_MODEL
{
  public function getTrackByReccu($reccu)
  {
    $this->db->select('track.reccu, track.status, track.cab_id, track.createdAt, cabang.id_cab, cabang.kd_cab, cabang.nama_cab');
    $this->db->from('track');
    $this->db->where('track.reccu', $reccu);
    $this->db->join('cabang', 'cabang.id_cab = track.cab_id');
    $this->db->order_by('createdAt', 'desc');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataReccu($reccu)
  {
    $this->db->select('track.reccu, track.status, track.cab_id, track.createdAt');
    $this->db->from('track');
    $this->db->where('track.reccu=', $reccu);
    $query = $this->db->get()->result();
    return $query;
  }
}
