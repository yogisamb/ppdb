<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sistem_model', 'sis');
    $this->load->model('User_model', 'usr');
    is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Profile';
    $data['submenu'] = 'Profile';
    $data['supersubmenu'] = 'Profile';
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('profile/settingprofile', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function ubahfoto()
  {
    $data['user'] = $this->usr->getUserlog();
    $username = $data['user']['user_name'];
    $upload_file = $_FILES['file'];
    if ($upload_file) {
      $config['allowed_types'] = 'png|jpg|jpeg|gif';
      $config['upload_path']   = './assets/images/user_profile/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('file')) {
        if ($data['user']['user_image'] != 'default.png') {
          unlink(FCPATH . 'assets/images/user_profile/' . $data['user']['user_image']);
        }
        $upload_data = $this->upload->data();
        $nama_random = 'foto_profile';
        $path = $upload_data['file_path'];
        $old_name = $upload_data['raw_name'] . $upload_data['file_ext'];
        $angka_acak = mt_rand();
        $new_name = $nama_random .  '_' . $username . '_' . $angka_acak . $upload_data['file_ext'];
        $dataisi = [
          'user_image' => $new_name
        ];
        rename($path . $old_name, $path . $new_name); // ganti nama image dengan nama & id_event
      } else {
        $error =  $this->upload->display_errors();
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', '' . $error . '');
        redirect('profile'); // supaya berhenti di sini, kalo lanjut, nanti presensi tanpa gambar
      }
    }
    $this->usr->editDataprofil($dataisi);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Berhasil Diubah');
    redirect('profile');
  }

  public function ubahpassword()
  {
    $data['user'] = $this->usr->getUserlog();
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[6]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Password2', 'required|trim|min_length[6]|matches[password1]');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Cek! Form Belum Terisi semua!');
      redirect('profile');
    } else {
      $input = $this->input->post(null, true);
      $curent_password = $input['password'];
      $new_password = $input['password2'];
      if (!password_verify($curent_password, $data['user']['user_password'])) {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Gagal Diubah');
        redirect('profile');
      } else {
        $password_hash = [
          'user_password' => password_hash($new_password, PASSWORD_DEFAULT),
          'user_password_mask' => $this->encryptor->enkrip('enkrip', $new_password)
        ];

        $this->usr->editDataprofil($password_hash);
        $this->session->set_flashdata('message1', 'success');
        $this->session->set_flashdata('message2', 'Berhasil Diubah');
        redirect('profile');
      }
    }
  }
}
