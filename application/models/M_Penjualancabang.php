<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Penjualancabang extends CI_MODEL
{
  public function getData($userkota, $usercab)
  {
    $this->db->select('paket.id_paket, paket.kotaasal_id, paket.kotatujuan_id, paket.cabasal_id, paket.cabtujuan_id, paket.reccu, paket.kd_paket, paket.koli, paket.pengirim, paket.penerima, paket.createdAt, paket.receivedAt, kota.id_kota, kota.nama_kota kotaasal, cabang.id_cab, cabang.nama_cab cabasal, a.id_kota, a.nama_kota kotatujuan, b.id_cab, b.nama_cab cabtujuan');
    $this->db->from('paket');
    $this->db->join('kota', 'kota.id_kota = paket.kotaasal_id');
    $this->db->join('kota a', 'a.id_kota = paket.kotatujuan_id');
    $this->db->join('cabang', 'cabang.id_cab = paket.cabasal_id');
    $this->db->join('cabang b', 'b.id_cab = paket.cabtujuan_id');
    $this->db->where('paket.cabasal_id !=', $usercab);
    $this->db->where('paket.kotatujuan_id', $userkota);
    $query = $this->db->get()->result();
    return $query;
  }

  public function getDataTujuanLain($userkota)
  {
    $this->db->select('paket.id_paket, paket.reccu, paket.kd_paket');
    $this->db->from('paket');
    $this->db->where('kotaasal_id =', $userkota);
    $this->db->where('kotatujuan_id !=', $userkota);
    $this->db->where('cabSentAt =', null);
    $sql = $this->db->get()->result();
    return $sql;
  }

  public function getDataReccuTujuanLain($userkota)
  {
    $this->db->select('id_paket, reccu, kd_paket');
    $this->db->from('paket');
    $this->db->where('kotaasal_id =', $userkota);
    $this->db->where('kotatujuan_id !=', $userkota);
    $sql = $this->db->get()->result();
    return $sql;
  }

  public function getDataRowReccu($reccu)
  {
    $this->db->select('reccu');
    $this->db->from('paket');
    $this->db->where('reccu', $reccu);
    $query = $this->db->get()->row();
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
}
