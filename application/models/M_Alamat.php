<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Alamat extends CI_MODEL
{
  public function getData()
  {
    $this->db->select('alamat.id_alamat, alamat.alamat, alamat.kota_id, alamat.daerah, alamat.notelp, alamat.kdpos, kota.id_kota, kota.nama_kota');
    $this->db->from('alamat');
    $this->db->join('kota', 'kota.id_kota = alamat.kota_id');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataId($id)
  {
    $this->db->select('alamat.id_alamat, alamat.alamat, alamat.kota_id, alamat.daerah, alamat.notelp, alamat.kdpos, kota.id_kota, kota.nama_kota');
    $this->db->from('alamat');
    $this->db->join('kota', 'kota.id_kota = alamat.kota_id');
    $this->db->where('alamat.id_alamat', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function addData()
  {
    $kotaid     = $this->input->post('kotaid');
    $alamat     = $this->input->post('alamat');
    $daerah     = trim($this->input->post('daerah'));
    $notelp     = trim($this->input->post('notelp'));
    $kdpos      = trim($this->input->post('kdpos'));
    $time       = date('Y-m-d H:i:s');

    $data = array(
      'kota_id'     => $kotaid,
      'alamat'      => $alamat,
      'daerah'      => strtolower($daerah),
      'kdpos'       => strtolower($kdpos),
      'notelp'      => $notelp,
      'createdAt'   => $time,
    );

    $this->db->insert('alamat', $data);
  }

  public function editData($id)
  {
    $kotaid     = $this->input->post('kotaid');
    $alamat     = trim($this->input->post('alamat'));
    $daerah     = trim($this->input->post('daerah'));
    $notelp     = trim($this->input->post('notelp'));
    $kdpos      = trim($this->input->post('kdpos'));

    $data = array(
      'kota_id'     => $kotaid,
      'alamat'      => strtolower($alamat),
      'daerah'      => strtolower($daerah),
      'kdpos'       => strtolower($kdpos),
      'notelp'      => strtolower($notelp),
    );

    $where = array('id_alamat' => $id);

    $this->db->update('alamat', $data, $where);
  }

  public function deleteData($id)
  {
    return $this->db->delete('alamat', ['id_alamat' => $id]);
  }
}
