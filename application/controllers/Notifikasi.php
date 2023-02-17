<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
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
    if (!$this->session->userdata('user_email')) {
      redirect('auth');
    }
    $this->load->model('User_model', 'usr');
    $this->load->model('Sistem_model', 'sis');
  }

  public function index($tb_notifikasi_id)
  {
    $notifikasiid = $this->encryptor->enkrip('dekrip', $tb_notifikasi_id);
    $notifikasi = $this->sis->getNotifikasi($notifikasiid);
    $submenu = $this->sis->getSubmenu($notifikasi['user_sub_menu_id']);
    $this->sis->deleteNotifikasi($notifikasiid);
    redirect($submenu['user_sub_menu_url']);
  }
}
