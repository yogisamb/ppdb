<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('sistem_model', 'sis');
    $this->load->model('user_model', 'usr');
    $this->load->model('auth_model', 'auth');
    is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index($user_role_id = false)
  {
    $this->form_validation->set_rules('password', 'Password', 'Trim|required');
    $this->form_validation->set_rules('id', 'Id', 'Trim|required');
    $data['user'] = $this->usr->getUserlog();
    if ($this->form_validation->run() == false) {
      $data['profile'] = null;
    } else {
      $input = $this->input->post(null, true);
      if (password_verify($input['password'], $data['user']['user_password'])) {
        $data['profile'] = $this->usr->getUser($this->encryptor->enkrip('dekrip', $input['id']));
      } else {
        $data['profile'] = null;
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Password Salah!');
      }
    }
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Admin';
    $data['submenu'] = 'Manajemen User';
    $data['supersubmenu'] = 'Data User';
    $data['datauser'] = $this->usr->getUser();
    $data['role'] = $this->sis->getRole();
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('admin/datauser', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function ubahrolemaster()
  {
    $this->form_validation->set_rules('jobdesk', 'Jobdesk', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'danger');
      $this->session->set_flashdata('message2', 'data <b>Kosong!</b>');
      redirect('management/user');
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'user_role_id' => $input['jobdesk'],
      ];
      $this->db->where('user_id', $input['id']);
      $this->db->update('user', $dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Berhasil Ubah Role Master');
      redirect('admin');
    }
  }

  public function tambahuser()
  {
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.user_name]', [
      'required' => 'Form Tidak Boleh Kosong!',
      'is_unique' => 'Username Sudah Terdaftar!'
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.user_email]', [
      'valid_email' => 'Email Anda Tidak Valid!',
      'required' => 'Form Tidak Boleh Kosong!',
      'is_unique' => 'Email Sudah Terdaftar!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
      'required' => 'Form Tidak Boleh Kosong!',
      'min_length' => 'Password Terlalu pendek, Minimal 8 karakter!'
    ]);
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Akun Gagal Disimpan! Cek Form Isian');
      redirect('management/user');
    } else {
      $input = $this->input->post(null, true);
      $this->auth->saveAuthsignupuser2($input);
      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $input['email'],
        'token' => $token,
        'date_created' => time()
      ];

      $this->db->insert('user_token', $user_token);

      $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Akun Baru Berhasil dibuat! Email Aktivasi telah dikirimkan ke ' . $input['email'] . '!');

      redirect('admin');
    }
  }

  private function _sendEmail($token, $type, $userid = false)
  {
    $emailconfig = $this->sis->getEmailconfig();

    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => $emailconfig['tb_config_email_text'],
      'smtp_pass' => $this->encryptor->enkrip('dekrip', $emailconfig['tb_config_email_password']),
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);
    $this->email->from($emailconfig['tb_config_email_text'], 'Penerimaan Siswa Baru Bintang Juara');

    if ($type == "verify") {
      $this->email->to($this->input->post('email'));
      $this->email->subject('Account Login Penerimaan Siswa Baru Bintang Juara');
      $this->email->message('
        <div style="justify-content: center">
          <div
            class=""
            style="
              border: 1px solid greenyellow;
              background-color: greenyellow;
              width: 800px;
              margin: 0 auto;
            "
          >
            <h3 style="text-align: center">Pembuatan akun anda Berhasil, Data akun kamu di website ' . base_url() . ', ada di bawah ini ya!</h3>
            <h4 style="text-align: center">Pastikan Data ini jangan sampai di ketahui oleh orang lain!</h4>
          </div>
          <div style="border: 1px solid greenyellow; width: 800px; margin: 0 auto">
            <table style="margin: 20px">
              <tbody>
                <tr>
                  <td style="font-weight: bold;">Email</td>
                  <td style="font-weight: bold;">: ' . $this->input->post('email') . '</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">Username</td>
                  <td style="font-weight: bold;">: ' . $this->input->post('username') . '</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">Password</td>
                  <td style="font-weight: bold;">: ' . $this->input->post('password') . '</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;" colspan="2">Klik Link ini untuk verifikasi email kamu di aplikasi PPDB Bintang Juara : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan Akun</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div
            style="
              border: 1px solid greenyellow;
              background-color: greenyellow;
              width: 800px;
              margin: 0 auto;
            "
          >
            <h4 style="text-align: center">Copyright &#169;' . date('Y') . ' All rights reserved - Akademik Bintang Juara</h4>
          </div>
        </div>
      ');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function isaktifuser($user_id)
  {
    $userid = $this->encryptor->enkrip('dekrip', $user_id);
    $user = $this->usr->getUser($userid);
    if ($user['is_active'] == 1) {
      $dataisi = [
        'is_active' => 0
      ];
    } else {
      $dataisi = [
        'is_active' => 1
      ];
    }
    $this->usr->editUser($userid, $dataisi);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Aktif User Berhasil Diubah');
    redirect('admin');
  }

  public function tambahwali()
  {
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.user_email]', [
      'is_unique' => 'This email is already registered!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
      'min_length' => 'Password too short!'
    ]);
    $this->form_validation->set_rules('namaayah', 'Namaayah', 'required');
    $this->form_validation->set_rules('telpayah', 'Telpayah', 'required');
    $this->form_validation->set_rules('pekerjaanayah', 'Pekerjaanayah', 'required');
    $this->form_validation->set_rules('umurayah', 'Umurayah', 'required');
    $this->form_validation->set_rules('namaibu', 'Namaibu', 'required');
    $this->form_validation->set_rules('telpibu', 'Telpibu', 'required');
    $this->form_validation->set_rules('pekerjaanibu', 'Pekerjaanibu', 'required');
    $this->form_validation->set_rules('umuribu', 'Umuribu', 'required');
    if ($this->form_validation->run() == false) {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Admin';
      $data['submenu'] = 'Manajemen User';
      $data['supersubmenu'] = 'Tambah Walisiswa';
      $data['datauser'] = $this->usr->getUser();
      $data['role'] = $this->sis->getRole();
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('admin/tambahwali', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $datauser = [
        'user_profile' => $input['namaayah'],
        'user_name' => $input['namaayah'],
        'user_email' => $input['email'],
        'user_role_id' => '9',
        'user_image' => 'default.png',
        'user_password' => password_hash($input['password'], PASSWORD_DEFAULT),
        'user_password_mask' => $this->encryptor->enkrip('enkrip', $input['password']),
        'is_active' => 0,
        'user_date_created' => date('Y/m/d')
      ];
      $this->db->insert('user', $datauser);
      $id2 = $this->db->insert_id();

      $dataorangtua = [
        "user_id" => $id2,
        "tb_dataanak_nama_ayah" => $input['namaayah'],
        "tb_dataanak_telp_ayah" => $input['telpayah'],
        "tb_dataanak_pekerjaan_ayah" => $input['pekerjaanayah'],
        "tb_dataanak_umur_ayah" => $input['umurayah'],
        "tb_dataanak_nama_ibu" => $input['namaibu'],
        "tb_dataanak_telp_ibu" => $input['telpibu'],
        "tb_dataanak_pekerjaan_ibu" => $input['pekerjaanibu'],
        "tb_dataanak_umur_ibu" => $input['umuribu'],
      ];
      $this->db->insert('tb_orangtua', $dataorangtua);
      $token = base64_encode(random_bytes(32));

      $user_token = [
        'email' => $input['email'],
        'token' => $token,
        'date_created' => time()
      ];
      $this->db->insert('user_token', $user_token);

      $dataisi = [
        'tb_tahun_title' => date('Y'),
        'user_id' => $id2,
        'tb_pembayaran_file' => ''
      ];
      $this->db->insert('tb_pembayaran', $dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Akun Baru Berhasil dibuat! Email Aktivasi telah dikirimkan ke ' . $input['email'] . '!');
      redirect('admin');
    }
  }
}
