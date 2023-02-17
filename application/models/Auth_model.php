<?php

class Auth_model extends CI_Model
{
  public function saveAuthsignupuser($input)
  {
    $data = [
      'user_name' => $input['username'],
      'user_email' => $input['email'],
      'image' => 'default.png',
      'user_password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
      'user_password_mask' => $this->encryptor->enkrip('enkrip', $input['password1']),
      'user_role_id' => 8,
      'is_active' => 0,
      'user_date_created' => date('Y/m/d'),
    ];
    $this->db->insert('user', $data);
    $id = $this->db->insert_id();
    $data_user = [
      'user_id' => $id,
      'user_data_alamat' => "alamat",
      'user_data_provinsi' => 0,
      'user_data_kabupaten_kota' => 0,
      'user_data_kecamatan' => 0,
      'user_data_kelurahan' => 0,
      'user_data_telp' => 0
    ];
    $this->db->insert('user_data', $data_user);
  }

  public function saveAuthsignupuser2($input)
  {
    $data = [
      'user_name' => $input['username'],
      'user_email' => $input['email'],
      'user_profile' => $input['email'],
      'user_image' => 'default.png',
      'user_password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'user_password_mask' => $this->encryptor->enkrip('enkrip', $input['password']),
      'user_role_id' => $input['role'],
      'is_active' => 0,
      'user_date_created' => date('Y/m/d'),
    ];
    $this->db->insert('user', $data);
  }
}
