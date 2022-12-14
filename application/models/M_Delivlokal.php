<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Delivlokal extends CI_MODEL
{
  public function getKd($usercab)
  {
    $date = date('mdYHis');
    $kd   = $usercab . 'lk' .  $date;
    return $kd;
  }

  public function getData()
  {
    $usercab    = $this->session->userdata('usercab_id');
    $userrole   = $this->session->userdata('role_access');

    if ($userrole == 'superadmin') {
      $this->db->select('delivlokal.id_delivlokal, delivlokal.kd_delivlokal, delivlokal.cab_id, delivlokal.kurir_id, delivlokal.total_reccu, delivlokal.createdAt, cabang.id_cab, cabang.nama_cab, user.id_user, user.nama_user');
      $this->db->from('delivlokal');
      $this->db->join('cabang', 'cabang.id_cab = delivlokal.cab_id');
      $this->db->join('user', 'user.id_user = delivlokal.kurir_id');
      $query = $this->db->get()->result();
      return $query;
    } else {
      $this->db->select('delivlokal.id_delivlokal, delivlokal.kd_delivlokal, delivlokal.cab_id, delivlokal.kurir_id, delivlokal.total_reccu, delivlokal.createdAt, cabang.id_cab, cabang.nama_cab, user.id_user, user.nama_user');
      $this->db->from('delivlokal');
      $this->db->join('cabang', 'cabang.id_cab = delivlokal.cab_id');
      $this->db->join('user', 'user.id_user = delivlokal.kurir_id');
      $this->db->where('delivlokal.cab_id', $usercab);
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
    $this->db->select('detail_lokal.id_detaillokal, detail_lokal.kd_delivlokal, detail_lokal.reccu, detail_lokal.status, detail_lokal.sentAt, delivlokal.kd_delivlokal, paket.reccu, paket.kd_paket');
    $this->db->from('detail_lokal');
    $this->db->join('delivlokal', 'delivlokal.kd_delivlokal = detail_lokal.kd_delivlokal');
    $this->db->join('paket', 'paket.reccu = detail_lokal.reccu');
    $this->db->where('detail_lokal.kd_delivlokal', $kd);
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDelivKurir()
  {
    $kurir = $this->session->userdata('id_user');

    $this->db->select('kd_delivlokal, total_reccu');
    $this->db->from('delivlokal');
    $this->db->where('delivlokal.kurir_id', $kurir);
    $this->db->order_by('id_delivlokal', 'desc');
    $this->db->limit(10);
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDetailDelivKurir()
  {
    $kurir = $this->session->userdata('id_user');

    $this->db->select('*');
    $this->db->from('delivlokal');
    $this->db->join('detail_lokal', 'detail_lokal.kd_delivlokal = delivlokal.kd_delivlokal');
    $this->db->where('delivlokal.kurir_id', $kurir);
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataDetailtId($id)
  {
    $this->db->select('*');
    $this->db->from('detail_lokal');
    $this->db->where('id_detaillokal', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getDelivKurirId($id)
  {
    $this->db->select('reccu');
    $this->db->from('detail_lokal');
    $this->db->where('id_detaillokal', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function addData($data, $detail, $track, $paket)
  {
    $this->db->insert('delivlokal', $data);
    $this->db->insert_batch('detail_lokal', $detail);
    $this->db->insert_batch('track', $track);
    $this->db->update_batch('paket', $paket, 'reccu');
  }

  public function updateDataDeliv($kd, $data, $detail)
  {
    $where = array(
      'kd_delivlokal' => $kd
    );

    $this->db->delete('detail_lokal', $where);
    $this->db->insert_batch('detail_lokal', $detail);
    $this->db->update('delivlokal', $data, $where);
  }

  public function updateDataPaketTrack($paket, $paketUpdate, $track, $trackUpdate)
  {
    $this->db->update_batch('paket', $paketUpdate, 'reccu');

    $action = 6;

    $this->db->select('reccu');
    $this->db->from('track');
    $this->db->where('actions =', $action);
    $this->db->where_in(['reccu' => $trackUpdate]);
    $this->db->delete();

    $this->db->update_batch('paket', $paket, 'reccu');
    $this->db->insert_batch('track', $track);
  }

  public function updateStats($id, $reccu, $penerima)
  {
    $sentAt       = date('Y-m-d H:i:s');
    $usercab      = $this->session->userdata('usercab_id');
    $kuririd      = $this->session->userdata('id_user');
    $status       = 'Paket telah diterima oleh ' . $penerima;

    $data = array(
      'status'    => $status,
      'sentAt'    => $sentAt
    );

    $where = array(
      'id_detaillokal'   => $id
    );

    $datapaket = array(
      'successAt'   => $sentAt
    );

    $wherereccu = array(
      'reccu'   => $reccu
    );

    $datatrack = array(
      'cab_id'      => $usercab,
      'reccu'       => $reccu,
      'status'      => $status,
      'actions'     => 7,
      'createdAt'   => $sentAt,
      'user_id'     => $kuririd,
    );

    $this->db->update('detail_lokal', $data, $where);
    $this->db->update('paket', $datapaket, $wherereccu);
    $this->db->insert('track', $datatrack);
  }

  public function delete($kd)
  {
    $this->db->select('reccu');
    $this->db->from('detail_lokal');
    $this->db->where('kd_delivlokal', $kd);
    $query = $this->db->get()->result();

    foreach ($query as $val) {
      $data[] = $val->reccu;
    }

    $sumdata = count($data);

    $paketupdate = [];

    for ($i = 0; $i < $sumdata; $i++) {
      array_push($paketupdate, ['reccu'   => $data[$i]]);
      $paketupdate[$i]['lokalSentAt']      = null;
    }

    $this->db->select('reccu');
    $this->db->from('paket');
    $this->db->where_in('reccu', $data);
    $this->db->update_batch('paket', $paketupdate, 'reccu');

    $action = 6;
    $this->db->select('reccu');
    $this->db->from('track');
    $this->db->where('actions =', $action);
    $this->db->where_in('reccu', $data);
    $this->db->delete();

    $this->db->delete('delivlokal', ['kd_delivlokal' => $kd]);
    $this->db->delete('detail_lokal', ['kd_delivlokal' => $kd]);
  }
}
