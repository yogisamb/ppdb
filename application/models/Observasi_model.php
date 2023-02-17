<?php

class Observasi_model extends CI_Model
{
  public function getObservasi($observasiid = false)
  {
    if ($observasiid) {
      return $this->db->get_where('tb_observasi', ['tb_observasi_id' => $observasiid])->row_array();
    } else {
      $this->db->where('is_active', 1);
      return $this->db->get('tb_observasi')->result_array();
    }
  }

  public function getSubobservasibyobservasiid($observasiid)
  {
    $this->db->where('is_active', 1);
    return $this->db->get_where('tb_observasi_sub', ['tb_observasi_id' => $observasiid])->result_array();
  }

  public function getSupersubobservasibysubobservasiid($subobservasiid)
  {
    return $this->db->get_where('tb_observasi_sub_super', ['tb_observasi_sub_id' => $subobservasiid])->result_array();
  }

  public function saveJawaban($dataisi)
  {
    $this->db->insert('tb_jawaban', $dataisi);
  }

  public function getJawabansuper($supersubid, $anakid)
  {
    return $this->db->get_where('tb_jawaban', ['tb_observasi_sub_super_id' => $supersubid, 'tb_dataanak_id' => $anakid])->row_array();
  }

  public function getJawabansub($subid, $anakid)
  {
    return $this->db->get_where('tb_jawaban', ['tb_observasi_sub_id' => $subid, 'tb_dataanak_id' => $anakid])->row_array();
  }

  public function getNilai($nilaiid = false)
  {
    if ($nilaiid) {
      return $this->db->get_where('tb_nilai', ['tb_nilai_id' => $nilaiid])->row_array();
    } else {
      return $this->db->get('tb_nilai')->result_array();
    }
  }

  public function getDataanakbytahun()
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      $this->db->where('tb_dataanak_pembayaran', 1);
      $this->db->where('tb_dataanak_tahun', $aktif['tb_tahun_id']);
      $this->db->order_by('tb_dataanak_statusditerima', 'ASC');
      $this->db->order_by('tb_dataanak_jadwal', 'ASC');
      return $this->db->get('tb_dataanak')->result_array();
    } else {
      return [];
    }
  }

  public function getRelasianakbywali($userid)
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      $this->db->where('user_id', $userid);
      $this->db->where('tb_tahun_id', $aktif['tb_tahun_id']);
      return $this->db->get('tb_relasi_anak')->result_array();
    } else {
      return [];
    }
  }

  public function getAktif($tahunid)
  {
    return $this->db->get_where('tb_tahun', ['tb_tahun_id' => $tahunid])->row_array();
  }
}
