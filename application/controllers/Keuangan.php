<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sistem_model', 'sis');
    $this->load->model('User_model', 'usr');
    $this->load->model('Bintangjuara_model', 'bj');
    $this->load->model('Observasi_model', 'obs');
    is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    $this->form_validation->set_rules('password', 'Password', 'Trim|required');
    $this->form_validation->set_rules('idanak', 'Idanak', 'Trim|required');
    $this->form_validation->set_rules('id', 'Id', 'Trim|required');
    $data['user'] = $this->usr->getUserlog();
    if ($this->form_validation->run() == false) {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Keuangan';
      $data['submenu'] = 'Data PPDB';
      $data['supersubmenu'] = 'Data PPDB';
      $data['datappdb'] = $this->bj->getDatappdbkeuangan();
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('keuangan/datappdb', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);

      if (password_verify($input['password'], $data['user']['user_password'])) {
        $dataanakku = [
          'tb_dataanak_pembayaran' => 1
        ];
        $this->bj->editAnak($this->encryptor->enkrip('dekrip', $input['idanak']), $dataanakku);

        $dataisi = [
          'tb_pembayaran_status' => 1
        ];
        $this->bj->editPembayaran($this->encryptor->enkrip('dekrip', $input['id']), $dataisi);



        $datanotif = [
          'tb_notifikasi_title' => 'Data PPDB Baru',
          'tb_notifikasi_subtitle' => 'Calon Siswa PPDB Baru',
          'tb_notifikasi_icon' => 'edit-3',
          'tb_notifikasi_color' => 'success',
          'user_sub_menu_id' => 10,
          'tb_notifikasi_date_created' => date('Y-m-d H:m:s'),
        ];
        $this->bj->saveNotifikasi($datanotif);

        $this->session->set_flashdata('message1', 'success');
        $this->session->set_flashdata('message2', 'Validasi data Telah Berhasil!');
        redirect('keuangan/index');
      } else {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Password Salah!');
        redirect('keuangan/index');
      }
    }
  }

  public function riwayat()
  {
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Keuangan';
    $data['submenu'] = 'Riwayat PPDB';
    $data['supersubmenu'] = 'Riwayat PPDB';
    $data['datappdb'] = $this->bj->getRiwayatppdbkeuangan();
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('keuangan/riwayatppdb', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function downloadbukti($file)
  {
    $dir = "assets/files/pembayaran/";
    $file_path = $dir . $file;
    $ctype = "application/octet-stream";
    if (!empty($file_path) && file_exists($file_path)) { /*check keberadaan file*/
      header("Pragma:public");
      header("Expired:0");
      header("Cache-Control:must-revalidate");
      header("Content-Control:public");
      header("Content-Description: File Transfer");
      header("Content-Type: $ctype");
      header("Content-Disposition:attachment; filename=\"" . basename($file_path) . "\"");
      header("Content-Transfer-Encoding:binary");
      header("Content-Length:" . filesize($file_path));
      flush();
      readfile($file_path);
      exit();
    } else {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'File Tidak Ada');
    }
  }

  public function lihat($tb_orangtua_id, $tb_tahun_id)
  {
    $tahunid = $this->encryptor->enkrip('dekrip', $tb_tahun_id);
    $waliid = $this->encryptor->enkrip('dekrip', $tb_orangtua_id);
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Keuangan';
    $data['submenu'] = 'Data PPDB';
    $data['supersubmenu'] = 'Data PPDB';
    $data['datappdb'] = $this->bj->getDataanakbywalitahun($tahunid, $waliid);
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('keuangan/dataanak', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function lihatriwayat($tb_orangtua_id)
  {
    $waliid = $this->encryptor->enkrip('dekrip', $tb_orangtua_id);
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Keuangan';
    $data['submenu'] = 'Data PPDB';
    $data['supersubmenu'] = 'Data PPDB';
    $data['datappdb'] = $this->bj->getDataanakbywalitnptahun($waliid);
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('keuangan/dataanak', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }
}
