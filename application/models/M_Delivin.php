<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Delivin extends CI_MODEL
{
  public function getData()
  {
    $userkota  = $this->session->userdata('userkota_id');
    $userrole = $this->session->userdata('role_access');

    if ($userrole == 'superadmin') {
      $this->db->select('delivcab.id_delivcab, delivcab.kd_delivcab, delivcab.kotaasal_id, delivcab.kotatujuan_id, delivcab.platno, delivcab.total_reccu, delivcab.createdAt, delivcab.updatedAt, kota.id_kota, kota.nama_kota asal, a.id_kota, a.nama_kota tujuan');
      $this->db->from('delivcab');
      $this->db->join('kota', 'kota.id_kota = delivcab.kotaasal_id');
      $this->db->join('kota a', 'a.id_kota = delivcab.kotatujuan_id');
      $query = $this->db->get()->result();
      return $query;
    } else {
      $this->db->select('delivcab.id_delivcab, delivcab.kd_delivcab, delivcab.kotaasal_id, delivcab.kotatujuan_id, delivcab.platno, delivcab.total_reccu, delivcab.createdAt, delivcab.updatedAt, kota.id_kota, kota.nama_kota asal, a.id_kota, a.nama_kota tujuan');
      $this->db->from('delivcab');
      $this->db->join('kota', 'kota.id_kota = delivcab.kotaasal_id');
      $this->db->join('kota a', 'a.id_kota = delivcab.kotatujuan_id');
      $this->db->where('delivcab.kotatujuan_id', $userkota);
      $query = $this->db->get()->result();
      return $query;
    }
  }

  public function getDataKd($kd)
  {
    $this->db->select('delivlokal.id_delivlokal, delivlokal.kd_delivlokal, delivlokal.cab_id, delivlokal.kurir_id, delivlokal.total_reccu, delivlokal.createdAt, cabang.id_cab, cabang.nama_cab, user.id_user, user.nama_user');
    $this->db->from('delivlokal');
    $this->db->join('cabang', 'cabang.id_cab = delivlokal.cab_id');
    $this->db->join('user', 'user.id_user = delivlokal.kurir_id');
    $this->db->where('delivlokal.kd_delivlokal', $kd);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getDetailKd($kd)
  {
    $this->db->select('detail_lokal.kd_delivlokal, detail_lokal.reccu, detail_lokal.status, detail_lokal.sentAt, delivlokal.kd_delivlokal, paket.reccu, paket.kd_paket');
    $this->db->from('detail_lokal');
    $this->db->join('delivlokal', 'delivlokal.kd_delivlokal = detail_lokal.kd_delivlokal');
    $this->db->join('paket', 'paket.reccu = detail_lokal.reccu');
    $this->db->where('detail_lokal.kd_delivlokal', $kd);
    $query = $this->db->get()->result();
    return $query;
  }

  public function addData($data, $detail, $track, $paket)
  {
    $this->db->insert('delivlokal', $data);
    $this->db->insert_batch('detail_lokal', $detail);
    $this->db->insert_batch('track', $track);
    $this->db->update_batch('paket', $paket, 'reccu');
  }

  public function updateDeliv($kd, $track, $detail, $paket)
  {
    $data = array(
      'updatedAt'  => date('Y-m-d H:i:s')
    );

    $where = array(
      'kd_delivcab' => $kd
    );

    $this->db->update('delivcab', $data, $where);
    $this->db->update_batch('detail_cab', $detail, 'reccu');
    $this->db->update_batch('paket', $paket, 'reccu');
    $this->db->insert_batch('track', $track);
  }
}
