<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Kota extends CI_MODEL
{
  public function dataKd()
  {
    $this->db->select('RIGHT(kota.kd_kota,3) as kd_kota', FALSE);
    $this->db->order_by('kd_kota', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('kota');
    if ($query->num_rows() <> 0) {
      $data = $query->row();
      $kode = intval($data->kd_kota) + 1;
    } else {
      $kode = 1;
    }
    $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $kodetampil = "kt" . $batas;
    return $kodetampil;
  }

  public function getData()
  {
    return $this->db->get('kota')->result();
  }

  public function getDataId($id)
  {
    return $this->db->get_where('kota', ['id_kota' => $id])->row();
  }

  public function getByUserKota($userkota)
  {
    $this->db->select('id_kota, nama_kota');
    $this->db->from('kota');
    $this->db->where('kota.id_kota', $userkota);
    $query = $this->db->get()->row();
    return $query;
  }

  public function addData()
  {
    $kd     = $this->input->post('kdkota');
    $nama   = trim($this->input->post('namakota'));
    $time   = date('Y-m-d H:i:s');

    $data = array(
      'kd_kota'     => $kd,
      'nama_kota'   => strtolower($nama),
      'createdAt'   => $time,
    );

    $this->db->insert('kota', $data);
  }

  public function editData($id)
  {
    $kd     = $this->input->post('kdkota');
    $nama   = trim($this->input->post('namakota'));

    $data = array(
      'kd_kota'      => $kd,
      'nama_kota'    => strtolower($nama),
    );

    $where = array('id_kota' => $id);

    $this->db->update('kota', $data, $where);
  }

  public function deleteData($id)
  {
    return $this->db->delete('kota', ['id_kota' => $id]);
  }
}
