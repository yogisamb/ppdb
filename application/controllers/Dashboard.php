<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
    $this->load->model('sistem_model', 'sis');
    $this->load->model('User_model', 'usr');
    if (!$this->session->userdata('user_email')) {
      redirect('auth');
    }
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Dashboard';
    $data['submenu'] = 'Dashboard';
    $data['supersubmenu'] = 'Dashboard';
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('dashboard/index', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }
}
