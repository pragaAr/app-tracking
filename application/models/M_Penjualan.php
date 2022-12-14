<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_Penjualan extends CI_MODEL
{
  public function getData()
  {
    $this->db->select('paket.id_paket, paket.kotaasal_id, paket.kotatujuan_id, paket.cabasal_id, paket.cabtujuan_id, paket.reccu, paket.kd_paket, paket.koli, paket.pengirim, paket.penerima, paket.createdAt, kota.id_kota, kota.nama_kota kotaasal, cabang.id_cab, cabang.nama_cab cabasal, a.id_kota, a.nama_kota kotatujuan, b.id_cab, b.nama_cab cabtujuan');
    $this->db->from('paket');
    $this->db->join('kota', 'kota.id_kota = paket.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = paket.kotatujuan_id');
    $this->db->join('cabang', 'cabang.id_cab = paket.cabasal_id');
    $this->db->join('cabang b', 'b.id_cab = paket.cabtujuan_id');
    $query = $this->db->get()->result();
    return $query;
  }

  public function addData()
  {
    $iduser     = $this->session->userdata('id_user');

    $kotaasal     = $this->input->post('kotaasal');
    $kotatujuan   = $this->input->post('kotatujuan');
    $cabasal      = $this->input->post('cabasal');
    $cabtujuan    = $this->input->post('cabtujuan');
    $reccu        = $this->input->post('reccu');
    $kdpaket      = $this->input->post('kdpaket');
    $koli         = $this->input->post('koli');
    $pengirim     = $this->input->post('pengirim');
    $penerima     = $this->input->post('penerima');
    $time         = date('Y-m-d H:i:s');

    $data = array(
      'kotaasal_id'     => $kotaasal,
      'kotatujuan_id'   => $kotatujuan,
      'cabasal_id'      => $cabasal,
      'cabtujuan_id'    => $cabtujuan,
      'reccu'           => $reccu,
      'kd_paket'        => $kdpaket,
      'koli'            => $koli,
      'pengirim'        => $pengirim,
      'penerima'        => $penerima,
      'createdAt'       => $time,
      'user_id'         => $iduser
    );

    $this->db->select('cabang.id_cab, cabang.nama_cab');
    $this->db->from('cabang');
    $this->db->where('cabang.id_cab', $cabasal);
    $query = $this->db->get()->row();

    $cab      = $query;
    $namacab  = $cab->nama_cab;

    $datatrack = array(
      'cab_id'      => $cabasal,
      'reccu'       => $reccu,
      'status'      => 'paket telah diterima di ' . $namacab,
      'actions'     => 1,
      'createdAt'   => $time,
      'user_id'     => $iduser
    );

    $this->db->insert('paket', $data);
    $this->db->insert('track', $datatrack);
  }

  public function editData($noreccu)
  {
    $iduser     = $this->session->userdata('id_user');

    $kotaasal     = $this->input->post('kotaasal');
    $kotatujuan   = $this->input->post('kotatujuan');
    $cabasal      = $this->input->post('cabasal');
    $cabtujuan    = $this->input->post('cabtujuan');
    $reccunew     = $this->input->post('reccunew');
    $kdpaket      = strtolower($this->input->post('kdpaket'));
    $koli         = $this->input->post('koli');
    $pengirim     = strtolower($this->input->post('pengirim'));
    $penerima     = strtolower($this->input->post('penerima'));

    $data = array(
      'kotaasal_id'     => $kotaasal,
      'kotatujuan_id'   => $kotatujuan,
      'cabasal_id'      => $cabasal,
      'cabtujuan_id'    => $cabtujuan,
      'reccu'           => $reccunew,
      'kd_paket'        => $kdpaket,
      'koli'            => $koli,
      'pengirim'        => $pengirim,
      'penerima'        => $penerima,
      'user_id'         => $iduser
    );

    $where = array(
      'reccu' => $noreccu
    );

    $datatrack = array(
      'reccu' => $reccunew,
      'cab_id' => $cabasal
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
}
