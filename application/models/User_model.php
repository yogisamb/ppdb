<?php

use GuzzleHttp\Client;

class User_model extends CI_Model
{
  public function getAuthuser($email)
  {
    return $this->db->get_where('user', ['user_email' => $email])->row_array();
    // var_dump($result);
  }

  public function getAuthsignupuser($datauser)
  {
    $this->db->insert('user', $datauser);
  }

  public function getInsertuserdata($data_user)
  {
    $this->db->insert('user_data', $data_user);
  }

  public function getUserlog()
  {
    return $this->db->get_where('user', ['user_email' => $this->session->userdata('user_email')])->row_array();
  }

  public function getUser($userid = false)
  {
    if ($userid) {
      return $this->db->get_where('user', ['user_id' => $userid])->row_array();
    } else {
      return $this->db->get('user')->result_array();
    }
  }

  public function getUserdetail($user_id)
  {
    return $this->db->get_where('user', ['user_id' => $user_id])->row_array();
  }

  public function getUpdateuser($userid, $datauser)
  {
    $this->db->where('user_id', $userid);
    $this->db->update('user', $datauser);
  }

  public function getUserdatadetail($user_id)
  {
    return $this->db->get_where('user_data', ['user_id' => $user_id])->row_array();
  }

  public function getUserdataktpdetail($user_id)
  {
    return $this->db->get_where('user_data_ktp', ['user_id' => $user_id])->row_array();
  }

  public function getUserdata()
  {
    $user =  $this->db->get_where('user', ['user_email' => $this->session->userdata('user_email')])->row_array();
    return $this->db->get_where('user_data', ['user_id' => $user['user_id']])->row_array();
  }

  public function getUserdataktp()
  {
    $user =  $this->db->get_where('user', ['user_email' => $this->session->userdata('user_email')])->row_array();
    return $this->db->get_where('user_data_ktp', ['user_id' => $user['user_id']])->row_array();
  }


  public function getProvinsi($provinsiid = false)
  {
    if ($provinsiid == false) {
      return $this->db->get('tb_provinsi')->result_array();
    } else {
      return $this->db->get_where('tb_provinsi', ['id_provinsi' => $provinsiid])->row_array();
    }
  }

  public function getKabupaten($provinsiid)
  {
    if ($provinsiid == false) {
      return $this->db->get('tb_kabupaten_kota')->result_array();
    } else {
      return $this->db->get_where('tb_kabupaten_kota', ['id_provinsi' => $provinsiid])->result_array();
    }
  }

  public function getKabupatenbyid($kabupatenid)
  {
    return $this->db->get_where('tb_kabupaten_kota', ['id_kabupaten_kota' => $kabupatenid])->row_array();
  }

  public function getKecamatan($kabupatenid = false)
  {
    if ($kabupatenid == false) {
      return $this->db->get('tb_kecamatan')->result_array();
    } else {
      return $this->db->get_where('tb_kecamatan', ['id_kabupaten_kota' => $kabupatenid])->result_array();
    }
  }

  public function getKecamatanbyid($kecamatanid)
  {
    return $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $kecamatanid])->row_array();
  }

  public function getKelurahan($kecamatanid = false)
  {
    if ($kecamatanid == false) {
      return $this->db->get('tb_kelurahan')->result_array();
    } else {
      return $this->db->get_where('tb_kelurahan', ['id_kecamatan' => $kecamatanid])->result_array();
    }
  }

  public function getKelurahanbyid($kelurahanid)
  {
    return $this->db->get_where('tb_kelurahan', ['id_kelurahan' => $kelurahanid])->row_array();
  }


  public function updateUser($data)
  {
    $user =  $this->db->get_where('user', ['user_email' => $this->session->userdata('user_email')])->row_array();
    $this->db->where('user_id =', $user['user_id']);
    $this->db->update('user', $data);
  }

  public function editUser($userid, $dataisi)
  {
    $this->db->where('user_id', $userid);
    $this->db->update('user', $dataisi);
  }

  public function getUpdatepp($user)
  {
    $this->db->where('user_id =', $user);
    $this->db->update('user');
  }

  public function updateUserdata($data_user)
  {
    $user =  $this->db->get_where('user', ['user_email' => $this->session->userdata('user_email')])->row_array();
    $this->db->where('user_id =', $user['user_id']);
    $this->db->update('user_data', $data_user);
  }

  public function getUpdatepass($password_hash)
  {
    $this->db->where('user_email =', $this->session->userdata('user_email'));
    $this->db->update('user', $password_hash);
  }

  public function editDataprofil($dataisi)
  {
    $this->db->where('user_email =', $this->session->userdata('user_email'));
    $this->db->update('user', $dataisi);
  }

  public function getUsernum()
  {
    return $this->db->get('user')->num_rows();
  }

  public function getRole($userroleid = false)
  {
    if ($userroleid == false) {
      return $this->db->get('user_role')->result_array();
    } else {
      return $this->db->get_where('user_role', ['user_role_id' => $userroleid])->row_array();
    }
  }

  public function getRstpassadm($user, $data)
  {
    $this->db->where('user_id', $user);
    $this->db->update('user', $data);
  }

  public function getUserdataprovinsiuser($user_data)
  {
    return $this->db->get_where('tb_provinsi', ['id_provinsi' => $user_data])->row_array();
  }

  public function getUserdatakabupatenkotauser($user_data)
  {
    return $this->db->get_where('tb_kabupaten_kota', ['id_kabupaten_kota' => $user_data])->row_array();
  }

  public function getUserdatakecamatanuser($user_data)
  {
    return $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $user_data])->row_array();
  }

  public function getUserdatakelurahanuser($user_data)
  {
    return $this->db->get_where('tb_kelurahan', ['id_kelurahan' => $user_data])->row_array();
  }
}
