<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Cabang extends CI_MODEL
{
  public function dataKd()
  {
    $this->db->select('RIGHT(cabang.kd_cab,3) as kd_cab', FALSE);
    $this->db->order_by('kd_cab', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('cabang');
    if ($query->num_rows() <> 0) {
      $data = $query->row();
      $kode = intval($data->kd_cab) + 1;
    } else {
      $kode = 1;
    }
    $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $kodetampil = "cab" . $batas;
    return $kodetampil;
  }

  public function getData()
  {
    $userkota = $this->session->userdata('userkota_id');
    $userrole = $this->session->userdata('role_access');

    if ($userrole == 'superadmin') {
      $this->db->select('cabang.id_cab, cabang.kd_cab, cabang.kota_id, cabang.nama_cab, cabang.jenis_cab, kota.id_kota, kota.nama_kota');
      $this->db->from('cabang');
      $this->db->join('kota', 'kota.id_kota = cabang.kota_id');
      $query = $this->db->get()->result();
      return $query;
    } else {
      $this->db->select('cabang.id_cab, cabang.kd_cab, cabang.kota_id, cabang.nama_cab, cabang.jenis_cab, kota.id_kota, kota.nama_kota');
      $this->db->from('cabang');
      $this->db->join('kota', 'kota.id_kota = cabang.kota_id');
      $this->db->where('cabang.kota_id', $userkota);
      $query = $this->db->get()->result();
      return $query;
    }
  }

  public function getDataId($id)
  {
    $this->db->select('cabang.id_cab, cabang.kd_cab, cabang.kota_id, cabang.nama_cab, cabang.jenis_cab, kota.id_kota, kota.nama_kota');
    $this->db->from('cabang');
    $this->db->join('kota', 'kota.id_kota = cabang.kota_id');
    $this->db->where('cabang.id_cab', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getDataCabang()
  {
    $this->db->select('cabang.id_cab, cabang.kd_cab, cabang.kota_id, cabang.nama_cab, cabang.jenis_cab, kota.id_kota, kota.nama_kota');
    $this->db->from('cabang');
    $this->db->join('kota', 'kota.id_kota = cabang.kota_id');
    $this->db->where('jenis_cab =', 'cabang');
    $query = $this->db->get()->result();
    return $query;
  }

  public function addData()
  {
    $kd     = $this->input->post('kdcab');
    $kota   = $this->input->post('kotacab');
    $nama   = $this->input->post('namacab');
    $jenis  = $this->input->post('jeniscab');
    $time   = date('Y-m-d H:i:s');

    $datacab = array(
      'kd_cab'      => $kd,
      'kota_id'     => $kota,
      'nama_cab'    => $nama,
      'jenis_cab'   => $jenis,
      'createdAt'   => $time,
    );

    $this->db->insert('cabang', $datacab);
  }

  public function editData($id)
  {
    $kd     = $this->input->post('kdcab');
    $kota   = $this->input->post('kotacab');
    $nama   = trim($this->input->post('namacab'));
    $jenis  = trim($this->input->post('jeniscab'));

    $data = array(
      'kota_id'     => $kota,
      'kd_cab'      => $kd,
      'nama_cab'    => strtolower($nama),
      'jenis_cab'   => strtolower($jenis),
    );

    $where = array('id_cab' => $id);

    $this->db->update('cabang', $data, $where);
  }

  public function deleteData($id)
  {
    return $this->db->delete('cabang', ['id_cab' => $id]);
  }
}
