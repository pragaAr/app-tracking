<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Delivagen extends CI_MODEL
{
  public function getKd($usercab)
  {
    $date = date('mdYHis');
    $kd   = $usercab . 'agn' .  $date;
    return $kd;
  }

  public function getDataReccu($reccu)
  {
    $this->db->select('track.reccu, track.status, track.cab_id, track.createdAt');
    $this->db->from('track');
    $this->db->where('track.reccu=', $reccu);
    $query = $this->db->get()->result();
    return $query;
  }

  public function getData()
  {
    $usercab  = $this->session->userdata('usercab_id');
    $userkota = $this->session->userdata('userkota_id');
    $userrole = $this->session->userdata('role_access');

    if ($userrole == 'admagen') {
      $this->db->select('delivagen.id_delivagen, delivagen.kd_delivagen, delivagen.cab_id, delivagen.kurir_id, delivagen.total_reccu, delivagen.createdAt, delivagen.updatedAt, cabang.id_cab, cabang.nama_cab, user.id_user, user.nama_user');
      $this->db->from('delivagen');
      $this->db->join('cabang', 'cabang.id_cab = delivagen.cab_id');
      $this->db->join('user', 'user.id_user = delivagen.kurir_id');
      $this->db->where('delivagen.cab_id', $usercab);
      $query = $this->db->get()->result();
      return $query;
    } else {
      $this->db->select('delivagen.id_delivagen, delivagen.kd_delivagen, delivagen.cab_id, delivagen.kurir_id, delivagen.total_reccu, delivagen.createdAt, delivagen.updatedAt, cabang.id_cab, cabang.nama_cab, user.id_user, user.nama_user');
      $this->db->from('delivagen');
      $this->db->join('cabang', 'cabang.id_cab = delivagen.cab_id');
      $this->db->join('user', 'user.id_user = delivagen.kurir_id');
      $this->db->where('cabang.kota_id', $userkota);
      $query = $this->db->get()->result();
      return $query;
    }
  }

  public function getDataKd($kd)
  {
    $this->db->select('delivagen.id_delivagen, delivagen.kd_delivagen, delivagen.cab_id, delivagen.kurir_id, delivagen.total_reccu, delivagen.createdAt, cabang.id_cab, cabang.nama_cab, user.id_user, user.nama_user');
    $this->db->from('delivagen');
    $this->db->join('cabang', 'cabang.id_cab = delivagen.cab_id');
    $this->db->join('user', 'user.id_user = delivagen.kurir_id');
    $this->db->where('delivagen.kd_delivagen', $kd);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getDetailKd($kd)
  {
    $this->db->select('detail_agen.kd_delivagen, detail_agen.reccu, detail_agen.status, detail_agen.sentAt, delivagen.kd_delivagen, paket.reccu, paket.kd_paket');
    $this->db->from('detail_agen');
    $this->db->join('delivagen', 'delivagen.kd_delivagen = detail_agen.kd_delivagen');
    $this->db->join('paket', 'paket.reccu = detail_agen.reccu');
    $this->db->where('detail_agen.kd_delivagen', $kd);
    $query = $this->db->get()->result();
    return $query;
  }

  public function addData($data, $detail, $track, $paket)
  {
    $this->db->insert('delivagen', $data);
    $this->db->insert_batch('detail_agen', $detail);
    $this->db->insert_batch('track', $track);
    $this->db->update_batch('paket', $paket, 'reccu');
  }

  public function updateDeliv($kd, $track, $updatedetail, $updatepaket)
  {
    $data = array(
      'updatedAt'  => date('Y-m-d H:i:s')
    );

    $where = array(
      'kd_delivagen' => $kd
    );

    $this->db->update('delivagen', $data, $where);
    $this->db->update_batch('detail_agen', $updatedetail, 'reccu');
    $this->db->update_batch('paket', $updatepaket, 'reccu');
    $this->db->insert_batch('track', $track);
  }

  public function updateDataDeliv($kd, $data, $detail)
  {
    $where = array(
      'kd_delivagen' => $kd
    );

    $this->db->delete('detail_agen', $where);
    $this->db->insert_batch('detail_agen', $detail);
    $this->db->update('delivagen', $data, $where);
  }

  public function updateDataPaketTrack($paket, $paketUpdate, $track, $trackUpdate)
  {
    $this->db->update_batch('paket', $paketUpdate, 'reccu');

    $action = 2;

    $this->db->select('reccu');
    $this->db->from('track');
    $this->db->where('actions =', $action);
    $this->db->where_in(['reccu' => $trackUpdate]);
    $this->db->delete();

    $this->db->update_batch('paket', $paket, 'reccu');
    $this->db->insert_batch('track', $track);
  }

  public function delete($kd)
  {
    $this->db->select('reccu');
    $this->db->from('detail_agen');
    $this->db->where('kd_delivagen', $kd);
    $query = $this->db->get()->result();

    foreach ($query as $val) {
      $data[] = $val->reccu;
    }

    $sumdata = count($data);

    $paketupdate = [];

    for ($i = 0; $i < $sumdata; $i++) {
      array_push($paketupdate, ['reccu'   => $data[$i]]);
      $paketupdate[$i]['agenSentAt']      = null;
    }

    $this->db->select('reccu');
    $this->db->from('paket');
    $this->db->where_in('reccu', $data);
    $this->db->update_batch('paket', $paketupdate, 'reccu');

    $action = 1;
    $this->db->select('reccu');
    $this->db->from('track');
    $this->db->where('actions !=', $action);
    $this->db->where_in('reccu', $data);
    $this->db->delete();

    $this->db->delete('delivagen', ['kd_delivagen' => $kd]);
    $this->db->delete('detail_agen', ['kd_delivagen' => $kd]);
  }
}
