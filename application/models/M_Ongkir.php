<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Ongkir extends CI_MODEL
{
  public function getData()
  {
    $this->db->select('ongkir.id_ongkir, ongkir.kotaasal_id, ongkir.kotatujuan_id, ongkir.minimal, ongkir.perkg, ongkir.estimasi, kota.id_kota, kota.nama_kota asal, a.id_kota, a.nama_kota tujuan');
    $this->db->from('ongkir');
    $this->db->join('kota', 'kota.id_kota = ongkir.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = ongkir.kotatujuan_id');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataId($id)
  {
    $this->db->select('ongkir.id_ongkir, ongkir.kotaasal_id, ongkir.kotatujuan_id, ongkir.minimal, ongkir.perkg, ongkir.estimasi, kota.id_kota, kota.nama_kota asal, a.id_kota, a.nama_kota tujuan');
    $this->db->from('ongkir');
    $this->db->join('kota', 'kota.id_kota = ongkir.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = ongkir.kotatujuan_id');
    $this->db->where('ongkir.id_ongkir', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function addData()
  {
    $asal       = $this->input->post('kotaasal');
    $tujuan     = $this->input->post('kotatujuan');
    $minimal    = preg_replace("/[^0-9\.]/", "", $this->input->post('minimal'));
    $perkg      = preg_replace("/[^0-9\.]/", "", $this->input->post('perkg'));
    $estimasi   = $this->input->post('estimasi');
    $time       = date('Y-m-d H:i:s');

    $data = array(
      'kotaasal_id'     => $asal,
      'kotatujuan_id'   => $tujuan,
      'minimal'         => $minimal,
      'perkg'           => $perkg,
      'estimasi'        => $estimasi,
      'createdAt'       => $time,
    );

    $this->db->insert('ongkir', $data);
  }

  public function editData($id)
  {
    $asal       = $this->input->post('kotaasal');
    $tujuan     = $this->input->post('kotatujuan');
    $minimal    = preg_replace("/[^0-9\.]/", "", $this->input->post('minimal'));
    $perkg      = preg_replace("/[^0-9\.]/", "", $this->input->post('perkg'));
    $estimasi   = trim($this->input->post('estimasi'));

    $data = array(
      'kotaasal_id'     => $asal,
      'kotatujuan_id'   => $tujuan,
      'minimal'         => $minimal,
      'perkg'           => $perkg,
      'estimasi'        => strtolower($estimasi),
    );

    $where = array('id_ongkir' => $id);

    $this->db->update('ongkir', $data, $where);
  }

  public function deleteData($id)
  {
    return $this->db->delete('ongkir', ['id_ongkir' => $id]);
  }
}
