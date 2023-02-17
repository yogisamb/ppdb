<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
    $this->load->model('Bintangjuara_model', 'bj');
  }

  public function index()
  {
    $data['title'] = "Login";
    if ($this->session->userdata('user_email')) {
      redirect('profile');
    }
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Beranda';
      $this->load->view('templates/landingpage_header', $data);
      $this->load->view('auth/login', $data);
      $this->load->view('templates/landingpage_footer');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $input = $this->input->post(NULL, TRUE);
    $email = $input['email'];
    $password = $input['password'];

    $user = $this->usr->getAuthuser($email);

    if ($user) {
      // usernya ada
      if ($user['is_active'] == 1 and !empty($password)) { // .widibaka saya tambahin syarat password ga boleh kosong
        // cek password
        if (password_verify($password, $user['user_password'])) {
          $data = [
            'user_email' => $user['user_email'],
            'user_role_id' => $user['user_role_id']
          ];
          $this->session->set_userdata($data);
          if ($user['user_role_id'] != 9) {
            $this->session->set_flashdata('message1', 'success');
            $this->session->set_flashdata('message2', 'Berhasil Login');
            redirect('dashboard');
          } else {
            $this->session->set_flashdata('message1', 'success');
            $this->session->set_flashdata('message2', 'Berhasil Login');
            redirect('welcome');
          }
        } else {
          $this->session->set_flashdata('message1', 'error');
          $this->session->set_flashdata('message2', 'Wrong Credentials!');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Wrong Credentials!');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Wrong Credentials!');
      redirect('auth');
    }
  }

  public function forgotpassword()
  {
    $data['title'] = "Forgot Password";
    if ($this->session->userdata('user_email')) {
      redirect('landingpage');
    }
    $this->form_validation->set_rules('email', 'Email', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('auth/forgotpassword', $data);
    } else {
      $input = $this->input->post(null, true);
      $email = $input['email'];
      $user = $this->db->get_where('user', ['user_email' => $email, 'is_active' => 1])->row_array();
      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];

        $this->db->insert('user_token', $user_token);
        $this->_sendEmail($token, 'forgot', $user['user_id']);

        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Wrong Credentials!');
        redirect('auth');
      } else {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Wrong Credentials!');
        redirect('auth/forgotpassword');
      }
    }
  }

  private function _sendEmail($token, $type, $userid = false)
  {
    $emailconfig = $this->bj->getEmailconfig();

    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => $emailconfig['tb_config_email'],
      'smtp_pass' => $this->encryptor->enkrip('dekrip', $emailconfig['tb_config_password']),
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);
    $this->email->from($emailconfig['tb_config_email'], 'PPDB Bintang Juara');

    if ($type == "verify") {
      $this->email->to($this->input->post('email'));
      $this->email->subject('Account Login PPDB Bintang Juara');
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
            <h4 style="text-align: center">Copyright &#169;' . date('Y') . ' All rights reserved - PPDB Bintang Juara</h4>
          </div>
        </div>
      ');
    } else if ($type == "forgot") {
      $user = $this->usr->getUserdetail($userid);
      $ttl = $this->bj->getJudul();
      $this->email->to($user['user_email']);
      $this->email->subject('Forgot Password Sekolah Adi Pangastuti');
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
            <h3 style="text-align: center">Data akun kamu di website ' . base_url() . ', ada di bawah ini ya!</h3>
            <h4 style="text-align: center">Pastikan Data ini jangan sampai di ketahui oleh orang lain!</h4>
          </div>
          <div style="border: 1px solid greenyellow; width: 800px; margin: 0 auto">
            <table style="margin: 20px">
              <tbody>
                <tr>
                  <td style="font-weight: bold;" colspan="2">Klik Link ini untuk melakukan reset password di Website ' . $ttl['tb_config_isi'] . '  : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a></td>
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
            <h4 style="text-align: center">Copyright &#169;' . date('Y') . ' All rights reserved - PPDB Bintang Juara</h4>
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

  public function resetpassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['user_email' => $email, 'is_active' => 1])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if ($user_token) {
        $this->session->set_userdata('reset_email', $email);
        $this->changepassword();
      } else {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Reset Password Gagal');
        redirect('auth/forgotpassword');
      }
    } else {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Reset Password Gagal');
      redirect('auth/forgotpassword');
    }
  }

  public function changepassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    }
    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');
    if ($this->form_validation->run() == false) {
      $data['title'] = "Reset Password";
      $this->load->view('auth/resetpassword', $data);
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('user_password', $password);
      $this->db->where('user_email', $email);
      $this->db->update('user');

      $this->db->where('email', $email);
      $this->db->delete('user_token');

      $this->session->unset_userdata('reset_email');
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Reset Password Berhasil');
      redirect('auth');
    }
  }

  public function blocked()
  {
    $this->load->view('auth/blocked');
  }

  public function logout()
  {
    $this->session->unset_userdata('user_email');
    $this->session->unset_userdata('user_role_id');
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Berhasil Logout');
    redirect('auth');
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['user_email' => $email])->row_array();
    if ($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->db->set('is_active', 1);
          $this->db->where('user_email', $email);
          $this->db->update('user');
          $this->db->delete('user_token', ['email' => $email]);
          $this->session->set_flashdata('message1', 'success');
          $this->session->set_flashdata('message2', 'Berhasil Aktivasi');
          redirect('auth');
        } else {
          $this->db->delete('user_token', ['email' => $email]);
          $this->session->set_flashdata('message1', 'error');
          $this->session->set_flashdata('message2', 'Aktivasi Akun gagal, Hubungi CS');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Aktivasi Akun gagal, Hubungi CS');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Aktivasi Akun gagal, Hubungi CS');
      redirect('auth');
    }
  }
}
