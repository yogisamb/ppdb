<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrasi extends CI_Controller
{

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   *	- or -
   * 		http://example.com/index.php/welcome/index
   *	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model', 'usr');
  }

  public function index()
  {
    redirect('auth');
  }


  public function getkotakabupaten()
  {
    $id = $this->input->post('id');

    $data = [
      'id_provinsi' => $id
    ];

    $result = $this->db->get_where('tb_kabupaten_kota', $data)->result_array();
    $hasil = '<option value="0"> -- Pilih Kabupaten Kota -- </option>';
    foreach ($result as $r) {
      $hasil .= '<option value="' . $r['id_kabupaten_kota'] . '">' . $r['name'] . '</option>';
    };
    echo json_encode($hasil);
  }

  public function getkecamatan()
  {
    $id = $this->input->post('id');

    $data = [
      'id_kabupaten_kota' => $id
    ];

    $result = $this->db->get_where('tb_kecamatan', $data)->result_array();
    $hasil = '<option value="0"> -- Pilih Kecamatan -- </option>';
    foreach ($result as $r) {
      $hasil .= '<option value="' . $r['id_kecamatan'] . '">' . $r['name'] . '</option>';
    };
    echo json_encode($hasil);
  }

  public function getkelurahan()
  {
    $id = $this->input->post('id');

    $data = [
      'id_kecamatan' => $id
    ];

    $result = $this->db->get_where('tb_kelurahan', $data)->result_array();
    $hasil = '<option value="0"> -- Pilih Kelurahan -- </option>';
    foreach ($result as $r) {
      $hasil .= '<option value="' . $r['id_kelurahan'] . '">' . $r['name'] . '</option>';
    };
    echo json_encode($hasil);
  }

  public function getemail()
  {
    $email = $this->input->post('email');

    $data = [
      'user_email' => $email
    ];
    $result = $this->db->get_where('user', $data)->row_array();
    if ($result) {
      $hasil = '<p style="color: red; font-size: 10px;">Email Sudah Terpakai</p>';
    } else {
      $hasil = '<p style="color: green; font-size: 10px;">Email Tersedia</p>';
    }

    echo json_encode($hasil);
  }

  public function getusername()
  {
    $username = $this->input->post('username');

    $data = [
      'user_name' => $username
    ];
    $result = $this->db->get_where('user', $data)->row_array();
    if ($result) {
      $hasil = '<p style="color: red; font-size: 10px;">Username Sudah Terpakai</p>';
    } else {
      $hasil = '<p style="color: green; font-size: 10px;">Username Tersedia</p>';
    }

    echo json_encode($hasil);
  }

  public function random()
  {
    function generateRandomString($length = 10)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }
    $dataisi = generateRandomString();
    echo json_encode($dataisi);
  }
}
