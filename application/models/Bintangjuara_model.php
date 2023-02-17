<?php

use GuzzleHttp\Client;

class Bintangjuara_model extends CI_Model
{

  public function getKelurahan($kelurahanid = false)
  {
    if ($kelurahanid) {
      return $this->db->get_where('tb_kelurahan', ['id_kelurahan' => $kelurahanid])->row_array();
    } else {
      return $this->db->get('tb_kelurahan')->result_array();
    }
  }

  public function getkecamatan($kecamatanid = false)
  {
    if ($kecamatanid) {
      return $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $kecamatanid])->row_array();
    } else {
      return $this->db->get('tb_kecamatan')->result_array();
    }
  }

  public function getKabupatenkota($kabupaten_kotaid = false)
  {
    if ($kabupaten_kotaid) {
      return $this->db->get_where('tb_kabupaten_kota', ['id_kabupaten_kota' => $kabupaten_kotaid])->row_array();
    } else {
      return $this->db->get('tb_kabupaten_kota')->result_array();
    }
  }

  public function getProvinsi($provinsiid = false)
  {
    if ($provinsiid) {
      return $this->db->get_where('tb_provinsi', ['id_provinsi' => $provinsiid])->row_array();
    } else {
      return $this->db->get('tb_provinsi')->result_array();
    }
  }

  public function getSekolah($sekolahid = false)
  {
    if ($sekolahid) {
      return $this->db->get_where('tb_sekolah', ['tb_sekolah_id' => $sekolahid])->row_Array();
    } else {
      $this->db->ORDER_BY('tb_sekolah_alamat', 'ASC');
      return $this->db->get('tb_sekolah')->result_array();
    }
  }

  public function saveSekolah($dataisi)
  {
    $this->db->insert('tb_sekolah', $dataisi);
  }

  public function editSekolah($sekolahid, $dataisi)
  {
    $this->db->where('tb_sekolah_id', $sekolahid);
    $this->db->update('tb_sekolah', $dataisi);
  }

  public function getTahunajaran($taid = false)
  {
    if ($taid) {
      return $this->db->get_where('tb_tahun', ['tb_tahun_id' => $taid])->row_array();
    } else {
      $this->db->order_by('tb_tahun_id', 'DESC');
      return $this->db->get('tb_tahun')->result_array();
    }
  }

  public function saveTahunajaran($dataisi)
  {
    $this->db->insert('tb_tahun', $dataisi);
  }

  public function editTahunajaran($tahunid, $dataisi)
  {
    $this->db->where('tb_tahun_id', $tahunid);
    $this->db->update('tb_tahun', $dataisi);
  }

  public function getTahunaktif()
  {
    return $this->db->get_where('tb_tahun', ['is_active' => 1])->result_array();
  }

  public function getTahunaktifrow()
  {
    return $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
  }

  public function saveNotifikasi($dataisi)
  {
    $this->db->insert('tb_notifikasi', $dataisi);
  }

  public function getDatappdbkeuangan()
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      $this->db->order_by('tb_pembayaran_status', 'ASC');
      return $this->db->get_where('tb_pembayaran', ['tb_tahun_id' => $aktif['tb_tahun_id']])->result_array();
    } else {
      return [];
    }
  }

  public function getRiwayatppdbkeuangan()
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      $this->db->where('tb_tahun_id !=', $aktif['tb_tahun_id']);
      return $this->db->get('tb_pembayaran')->result_array();
    } else {
      return $this->db->get('tb_pembayaran')->result_array();
    }
  }

  public function getJumlahanakppdb($userid)
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      return $this->db->get_where('tb_relasi_anak', ['user_id' => $userid, 'tb_tahun_id' => $aktif['tb_tahun_id']])->num_rows();
    } else {
      return $this->db->get_where('tb_relasi_anak', ['user_id' => $userid])->num_rows();
    }
  }

  public function getWalisiswa($userid)
  {
    return $this->db->get_where('tb_orangtua', ['user_id' => $userid])->row_array();
  }

  public function editPembayaran($tb_pembayaran_id, $dataisi)
  {
    $this->db->where('tb_pembayaran_id', $tb_pembayaran_id);
    $this->db->update('tb_pembayaran', $dataisi);
  }

  public function getObservasi($observasiid = false)
  {
    if ($observasiid) {
      return $this->db->get_where('tb_observasi', ['tb_observasi_id' => $observasiid])->row_array();
    } else {
      return $this->db->get('tb_observasi')->result_array();
    }
  }

  public function saveObservasi($dataisi)
  {
    $this->db->insert('tb_observasi', $dataisi);
  }

  public function editObservasi($dataisi, $observasiid)
  {
    $this->db->where('tb_observasi_id', $observasiid);
    $this->db->update('tb_observasi', $dataisi);
  }

  public function getSubobservasibyobservasiid($observasiid)
  {
    return $this->db->get_where('tb_observasi_sub', ['tb_observasi_id' => $observasiid])->result_array();
  }

  public function saveObservasisub($dataisi)
  {
    $this->db->insert('tb_observasi_sub', $dataisi);
  }

  public function editSubobservasi($dataisi, $observasisubid)
  {
    $this->db->where('tb_observasi_sub_id', $observasisubid);
    $this->db->update('tb_observasi_sub', $dataisi);
  }

  public function getSubobservasi($subobservasiid = false)
  {
    if ($subobservasiid) {
      return $this->db->get_where('tb_observasi_sub', ['tb_observasi_sub_id' => $subobservasiid])->row_array();
    } else {
      return $this->db->get('tb_observasi_sub')->result_array();
    }
  }

  public function editSubbservasi($dataisi, $subobservasiid)
  {
    $this->db->where('tb_observasi_sub_id', $subobservasiid);
    $this->db->update('tb_observasi_sub', $dataisi);
  }

  public function getSupersubobservasibysubobservasiid($subobservasiid)
  {
    return $this->db->get_where('tb_observasi_sub_super', ['tb_observasi_sub_id' => $subobservasiid])->result_array();
  }

  public function saveSupersubobvervasi($dataisi)
  {
    $this->db->insert('tb_observasi_sub_super', $dataisi);
  }

  public function editSupersubobservasi($dataisi, $supersubobservasiid)
  {
    $this->db->where('tb_observasi_sub_super_id', $supersubobservasiid);
    $this->db->update('tb_observasi_sub_super', $dataisi);
  }

  public function getSupersubobservasi($supersubobservasiid = false)
  {
    if ($supersubobservasiid) {
      return $this->db->get_where('tb_observasi_sub_super', ['tb_observasi_sub_super_id' => $supersubobservasiid])->row_array();
    } else {
      return $this->db->get('tb_observasi_sub_super')->result_array();
    }
  }

  public function getDataanakbywalitahun($tahunid, $waliid)
  {
    return $this->db->get_where('tb_relasi_anak', ['user_id' => $waliid, 'tb_tahun_id' => $tahunid])->result_array();
  }

  public function getDataanakbywalitnptahun($waliid)
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      $this->db->where('tb_tahun_id !=', $aktif['tb_tahun_id']);
      return $this->db->get_where('tb_relasi_anak', ['user_id' => $waliid])->result_array();
    } else {
      return $this->db->get_where('tb_relasi_anak', ['user_id' => $waliid])->result_array();
    }
  }

  public function getDataanak($anakid = false)
  {
    if ($anakid) {
      return $this->db->get_where('tb_dataanak', ['tb_dataanak_id' => $anakid])->row_array();
    } else {
      return $this->db->get('tb_dataanak')->result_array();
    }
  }

  public function getDataanakbytahun()
  {
    $aktif = $this->db->get_where('tb_tahun', ['is_active' => 1])->row_array();
    if ($aktif) {
      $this->db->where('tb_dataanak_tahun', $aktif['tb_tahun_id']);
      $this->db->order_by('tb_dataanak_jadwal', 'ASC');
      return $this->db->get('tb_dataanak')->result_array();
    } else {
      return [];
    }
  }

  public function getWalibyanak($anakid)
  {
    $waliid = $this->db->get_where('tb_relasi_anak', ['tb_dataanak_id' => $anakid])->row_array();
    return $this->db->get_where('tb_orangtua', ['user_id' => $waliid['user_id']])->row_array();
  }


  public function editAnak($anakid, $dataisi)
  {
    $this->db->where('tb_dataanak_id', $anakid);
    $this->db->update('tb_dataanak', $dataisi);
  }

  public function getJawabanOT($anakid)
  {
    return $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $anakid])->row_array();
  }
}
