<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sistem_model', 'sis');
    $this->load->model('user_model', 'usr');
    is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index($user_role_id = false)
  {
    $roleid = $this->encryptor->enkrip('dekrip', $user_role_id);
    if (!$roleid) {
      $data['hakaksesuser'] = null;
      $data['roleuser'] = null;
    } else {
      $data['hakaksesuser'] = $this->sis->getMenuuser();
      $data['roleuser'] = $this->sis->getRole($roleid);
    }
    $data['hakakses'] = $this->sis->getRole();
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Manajemen';
    $data['submenu'] = 'Manajemen Sistem';
    $data['supersubmenu'] = 'Manajemen Hak Akses';
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('manajemen/hakakses', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function ubahakses()
  {
    $input = $this->input->post(null, true);
    $menu_id = $input['menuId'];
    $role_id = $input['roleId'];
    $dataisi = [
      'user_role_id' => $role_id,
      'user_menu_id' => $menu_id
    ];
    $this->sis->editHakakses($dataisi);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Akses Berhasil Diubah');
  }

  public function ubahrole()
  {
    $this->form_validation->set_rules('roleid', 'Roleid', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Gagal Diubah, Cek Form Input!');
      redirect('manajemen');
    } else {
      $input = $this->input->post(null, true);
      $this->sis->editRole($input['title'], $this->encryptor->enkrip('dekrip', $input['roleid']));
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'User Role Berhasil Diubah');
      redirect('manajemen');
    }
  }

  public function tambahrole()
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Gagal Diubah, Cek Form Input!');
      redirect('manajemen');
    } else {
      $input = $this->input->post(null, true);
      $this->sis->saveRole($input['title']);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'User Role Berhasil Ditambah');
      redirect('manajemen');
    }
  }

  public function konfigurasiemail()
  {
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Manajemen';
    $data['submenu'] = 'Konfigurasi Email';
    $data['supersubmenu'] = 'Konfigurasi Email';
    $data['config'] = $this->sis->getEmailconfig();
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('manajemen/konfigurasiemail', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_config_email_text' => $input['email'],
        'tb_config_email_password' => $this->encryptor->enkrip('enkrip', $input['password']),
      ];
      if (!$data['config']) {
        $this->sis->saveConfig($dataisi);
      } else {
        $this->sis->editConfig($dataisi);
      }
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Config telah berhasil disimpan!</div>');
      redirect('manajemen/konfigurasiemail');
    }
  }

  public function menu($user_menu_id = false)
  {
    $menuid = $this->encryptor->enkrip('dekrip', $user_menu_id);
    if (!$menuid) {
      $data['datamenuid'] = null;
      $data['datasubmenu'] = null;
    } else {
      $data['datamenuid'] = $this->sis->getMenu($menuid);;
      $data['datasubmenu'] = $this->sis->getSubmenubymenuid($menuid);
    }
    $data['datamenu'] = $this->sis->getMenu();
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Manajemen';
    $data['submenu'] = 'Manajemen Sistem';
    $data['supersubmenu'] = 'Manajemen Menu';
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('manajemen/menu', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function ubahmenu()
  {
    $this->form_validation->set_rules('menuid', 'Menuid', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Gagal Diubah, Cek Form Input!');
      redirect('manajemen/menu');
    } else {
      $input = $this->input->post(null, true);
      $this->sis->editMenu($input['title'], $this->encryptor->enkrip('dekrip', $input['menuid']));
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'User Menu Berhasil Diubah');
      redirect('manajemen/menu');
    }
  }

  public function isaktifsubmenu($user_sub_menu_id, $user_menu_id)
  {
    $submenuid = $this->encryptor->enkrip('dekrip', $user_sub_menu_id);
    $submenu = $this->sis->getSubmenu($submenuid);
    if ($submenu['is_active'] == 1) {
      $dataisi = [
        'is_active' => 0
      ];
    } else {
      $dataisi = [
        'is_active' => 1
      ];
    }
    $this->sis->editSubmenu($submenuid, $dataisi);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'User Sub Menu Berhasil Diubah');
    redirect('manajemen/menu/' . $user_menu_id);
  }
}
