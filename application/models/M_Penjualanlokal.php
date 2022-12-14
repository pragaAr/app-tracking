<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Penjualanlokal extends CI_MODEL
{
  public function getData()
  {
    $cabuser = $this->session->userdata('usercab_id');

    $this->db->select('paket.id_paket, paket.kotaasal_id, paket.kotatujuan_id, paket.cabasal_id, paket.cabtujuan_id, paket.reccu, paket.kd_paket, paket.koli, paket.pengirim, paket.penerima, paket.createdAt, kota.id_kota, kota.nama_kota kotaasal, cabang.id_cab, cabang.nama_cab cabasal, a.id_kota, a.nama_kota kotatujuan, b.id_cab, b.nama_cab cabtujuan');
    $this->db->from('paket');
    $this->db->join('kota', 'kota.id_kota = paket.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = paket.kotatujuan_id');
    $this->db->join('cabang', 'cabang.id_cab = paket.cabasal_id');
    $this->db->join('cabang b', 'b.id_cab = paket.cabtujuan_id');
    $this->db->where('paket.cabasal_id', $cabuser);
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataId($id)
  {
    $this->db->select('paket.id_paket, paket.kotaasal_id, paket.kotatujuan_id, paket.cabasal_id, paket.cabtujuan_id, paket.reccu, paket.kd_paket, paket.koli, paket.pengirim, paket.penerima, paket.createdAt, kota.id_kota, kota.nama_kota kotaasal, cabang.id_cab, cabang.nama_cab cabasal, a.id_kota, a.nama_kota kotatujuan, b.id_cab, b.nama_cab cabtujuan');
    $this->db->from('paket');
    $this->db->join('kota', 'kota.id_kota = paket.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = paket.kotatujuan_id');
    $this->db->join('cabang', 'cabang.id_cab = paket.cabasal_id');
    $this->db->join('cabang b', 'b.id_cab = paket.cabtujuan_id');
    $this->db->where('paket.id_paket', $id);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getPenjualanByReccu($reccu)
  {
    $this->db->select('paket.id_paket, paket.kotaasal_id, paket.kotatujuan_id, paket.cabasal_id, paket.cabtujuan_id, paket.reccu, paket.kd_paket, paket.koli, paket.pengirim, paket.penerima, paket.createdAt, kota.id_kota, kota.nama_kota kotaasal, cabang.id_cab, cabang.nama_cab cabasal, a.id_kota, a.nama_kota kotatujuan, b.id_cab, b.nama_cab cabtujuan');
    $this->db->from('paket');
    $this->db->join('kota', 'kota.id_kota = paket.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = paket.kotatujuan_id');
    $this->db->join('cabang', 'cabang.id_cab = paket.cabasal_id');
    $this->db->join('cabang b', 'b.id_cab = paket.cabtujuan_id');
    $this->db->where('paket.reccu', $reccu);
    $query = $this->db->get()->row();
    return $query;
  }

  public function getDataReccuNotSend($userkota)
  {
    $this->db->select('paket.id_paket, paket.reccu, paket.kd_paket');
    $this->db->from('paket');
    $this->db->where('kotatujuan_id', $userkota);
    $this->db->where('lokalSentAt =', null);
    $this->db->where('successAt =', null);
    $this->db->where('receivedAt !=', null);
    $sql = $this->db->get()->result();
    return $sql;
  }

  public function getDataReccuLokal($userkota)
  {
    $this->db->select('paket.id_paket, paket.reccu, paket.kd_paket');
    $this->db->from('paket');
    $this->db->where('kotatujuan_id', $userkota);
    $query = $this->db->get()->result();
    return $query;
  }

  public function addData()
  {
    $userid     = $this->session->userdata('id_user');
    $usercab    = $this->session->userdata('usercab_id');

    $this->db->select('cabang.id_cab, cabang.nama_cab');
    $this->db->from('cabang');
    $this->db->where('cabang.id_cab', $usercab);
    $query = $this->db->get()->row();

    $cab = $query;
    $namacabasal = $cab->nama_cab;

    $kotaasal     = $this->input->post('kotaasal');
    $kotatujuan   = $this->input->post('kotatujuan');
    $cabtujuan    = $this->input->post('cabtujuan');
    $reccu        = $this->input->post('reccu');
    $kdpaket      = $this->input->post('kdpaket');
    $koli         = $this->input->post('koli');
    $pengirim     = $this->input->post('pengirim');
    $penerima     = $this->input->post('penerima');
    $time         = date('Y-m-d H:i:s');

    $datalokal = array(
      'kotaasal_id'     => $kotaasal,
      'kotatujuan_id'   => $kotatujuan,
      'cabasal_id'      => $usercab,
      'cabtujuan_id'    => $cabtujuan,
      'reccu'           => $reccu,
      'kd_paket'        => $kdpaket,
      'koli'            => $koli,
      'pengirim'        => $pengirim,
      'penerima'        => $penerima,
      'createdAt'       => $time,
      'receivedAt'      => $time,
      'user_id'         => $userid
    );

    $datacab = array(
      'kotaasal_id'     => $kotaasal,
      'kotatujuan_id'   => $kotatujuan,
      'cabasal_id'      => $usercab,
      'cabtujuan_id'    => $cabtujuan,
      'reccu'           => $reccu,
      'kd_paket'        => $kdpaket,
      'koli'            => $koli,
      'pengirim'        => $pengirim,
      'penerima'        => $penerima,
      'createdAt'       => $time,
      'user_id'         => $userid
    );

    $datatrack = array(
      'cab_id'      => $usercab,
      'reccu'       => $reccu,
      'status'      => 'paket telah diterima di ' . $namacabasal,
      'actions'     => 1,
      'createdAt'   => $time,
      'user_id'     => $userid

    );

    if ($kotaasal == $kotatujuan) {
      $this->db->insert('paket', $datalokal);
    } else {
      $this->db->insert('paket', $datacab);
    }

    $this->db->insert('track', $datatrack);
  }

  public function editData($noreccu)
  {
    $usercab      = $this->session->userdata('usercab_id');
    $userid       = $this->session->userdata('id_user');

    $kotaasal     = $this->input->post('kotaasal');
    $kotatujuan   = $this->input->post('kotatujuan');
    $cabtujuan    = $this->input->post('cabtujuan');
    $reccunew     = $this->input->post('reccunew');
    $kdpaket      = strtolower($this->input->post('kdpaket'));
    $koli         = $this->input->post('koli');
    $pengirim     = strtolower($this->input->post('pengirim'));
    $penerima     = strtolower($this->input->post('penerima'));

    $data = array(
      'kotaasal_id'     => $kotaasal,
      'kotatujuan_id'   => $kotatujuan,
      'cabasal_id'      => $usercab,
      'cabtujuan_id'    => $cabtujuan,
      'reccu'           => $reccunew,
      'kd_paket'        => $kdpaket,
      'koli'            => $koli,
      'pengirim'        => $pengirim,
      'penerima'        => $penerima,
      'user_id'         => $userid
    );

    $where = array(
      'reccu' => $noreccu
    );

    $datatrack = array(
      'reccu' => $reccunew,
      'cab_id' => $usercab
    );

    $this->db->select('paket.reccu, detail_lokal.reccu');
    $this->db->from('paket');
    $this->db->join('detail_lokal', 'detail_lokal.reccu = paket.reccu');
    $this->db->where('detail_lokal.reccu', $noreccu);
    $querylokal = $this->db->get()->row();

    $datalokal = array(
      'reccu'   => $reccunew
    );

    $this->db->select('paket.reccu, detail_agen.reccu');
    $this->db->from('paket');
    $this->db->join('detail_agen', 'detail_agen.reccu = paket.reccu');
    $this->db->where('detail_agen.reccu', $noreccu);
    $queryagen = $this->db->get()->row();

    $dataagen = array(
      'reccu'   => $reccunew
    );

    $this->db->select('paket.reccu, detail_cab.reccu');
    $this->db->from('paket');
    $this->db->join('detail_cab', 'detail_cab.reccu = paket.reccu');
    $this->db->where('detail_cab.reccu', $noreccu);
    $querycab = $this->db->get()->row();

    $datacab = array(
      'reccu'   => $reccunew
    );

    if ($querylokal > 0) {
      $this->db->update('detail_lokal', $datalokal, $where);
    } elseif ($queryagen > 0) {
      $this->db->update('detail_agen', $dataagen, $where);
    } elseif ($querycab > 0) {
      $this->db->update('detail_cab', $datacab, $where);
    }

    $this->db->update('paket', $data, $where);
    $this->db->update('track', $datatrack, $where);
  }

  public function deleteData($reccu)
  {
    return $this->db->delete('detail_agen', ['reccu' => $reccu]);
    return $this->db->delete('detail_cab', ['reccu' => $reccu]);
    return $this->db->delete('detail_lokal', ['reccu' => $reccu]);
    return $this->db->delete('paket', ['reccu' => $reccu]);
    return $this->db->delete('track', ['reccu' => $reccu]);
  }
}
