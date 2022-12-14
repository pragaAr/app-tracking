<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Delivcabang extends CI_MODEL
{
  public function getKd($usercab)
  {
    $date = date('mdYHis');
    $kd   = $usercab . 'cab' .  $date;
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
      $this->db->where('delivcab.kotaasal_id', $userkota);
      $query = $this->db->get()->result();
      return $query;
    }
  }

  public function getDataKd($kd)
  {
    $this->db->select('delivcab.id_delivcab, delivcab.kd_delivcab, delivcab.kotaasal_id, delivcab.kotatujuan_id, delivcab.platno, delivcab.total_reccu, delivcab.createdAt, delivcab.updatedAt, kota.id_kota, kota.nama_kota asal, a.id_kota, a.nama_kota tujuan');
    $this->db->from('delivcab');
    $this->db->join('kota', 'kota.id_kota = delivcab.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = delivcab.kotatujuan_id');
    $this->db->where('delivcab.kd_delivcab', $kd);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getDetailKd($kd)
  {
    $this->db->select('detail_cab.kd_delivcab, detail_cab.reccu, detail_cab.status, detail_cab.sentAt, delivcab.kd_delivcab, paket.reccu, paket.kd_paket');
    $this->db->from('detail_cab');
    $this->db->join('delivcab', 'delivcab.kd_delivcab = detail_cab.kd_delivcab');
    $this->db->join('paket', 'paket.reccu = detail_cab.reccu');
    $this->db->where('detail_cab.kd_delivcab', $kd);
    $query = $this->db->get()->result();
    return $query;
  }



  public function addData($data, $detail, $track, $paket)
  {
    $this->db->insert('delivcab', $data);
    $this->db->insert_batch('detail_cab', $detail);
    $this->db->insert_batch('track', $track);
    $this->db->update_batch('paket', $paket, 'reccu');
  }

  public function updateDeliv($kd, $track, $updatedetail, $updatepaket)
  {
    $data = array(
      'updatedAt'  => date('Y-m-d H:i:s')
    );

    $where = array(
      'kd_delivcab' => $kd
    );

    $this->db->update('delivcab', $data, $where);
    $this->db->update_batch('detail_cab', $updatedetail, 'reccu');
    $this->db->update_batch('paket', $updatepaket, 'reccu');
    $this->db->insert_batch('track', $track);
  }

  public function updateDataDeliv($kd, $data, $detail)
  {
    $where = array(
      'kd_delivcab' => $kd
    );

    $this->db->delete('detail_cab', $where);
    $this->db->insert_batch('detail_cab', $detail);
    $this->db->update('delivcab', $data, $where);
  }

  public function updateDataPaketTrack($paket, $paketUpdate, $track, $trackUpdate)
  {
    $this->db->update_batch('paket', $paketUpdate, 'reccu');

    $action = 4;

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
    $this->db->from('detail_cab');
    $this->db->where('kd_delivcab', $kd);
    $query = $this->db->get()->result();

    foreach ($query as $val) {
      $data[] = $val->reccu;
    }

    $sumdata = count($data);

    $paketupdate = [];

    for ($i = 0; $i < $sumdata; $i++) {
      array_push($paketupdate, ['reccu'   => $data[$i]]);
      $paketupdate[$i]['cabSentAt']      = null;
    }

    $this->db->select('reccu');
    $this->db->from('paket');
    $this->db->where_in('reccu', $data);
    $this->db->update_batch('paket', $paketupdate, 'reccu');

    $action = 4;
    $this->db->select('reccu');
    $this->db->from('track');
    $this->db->where('actions =', $action);
    $this->db->where_in('reccu', $data);
    $this->db->delete();

    $this->db->delete('delivcab', ['kd_delivcab' => $kd]);
    $this->db->delete('detail_cab', ['kd_delivcab' => $kd]);
  }
}
