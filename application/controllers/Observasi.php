<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Observasi extends CI_Controller
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

  public function index($tb_dataanak_id = false)
  {
    if ($tb_dataanak_id) {
      $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
      $this->form_validation->set_rules('date', 'Date', 'required');
      if ($this->form_validation->run() == false) {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Gagal Menyimpan Data');
        redirect('observasi');
      } else {
        $input = $this->input->post(null, true);
        $dataisi = [
          'tb_dataanak_jadwal' => $input['date']
        ];
        $this->bj->editAnak($anakid, $dataisi);
        $this->session->set_flashdata('message1', 'success');
        $this->session->set_flashdata('message2', 'Data Berhasil diubah');
        redirect('observasi');
      }
    } else {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Observasi PPDB';
      $data['submenu'] = 'Data Observasi';
      $data['supersubmenu'] = 'Data Observasi';
      $data['dataanak'] = $this->obs->getDataanakbytahun();
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('observasi/dataobservasi', $data);
      $this->load->view('templates/dashboard_footer', $data);
    }
  }

  public function formobservasi($tb_dataanak_id)
  {
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Observasi PPDB';
    $data['submenu'] = 'Data Observasi';
    $data['supersubmenu'] = 'Data Observasi';
    $data['dataobservasi'] = $this->obs->getObservasi();
    $data['dataanak'] = $this->bj->getDataanak($anakid);
    $data['nilai'] = $this->obs->getNilai();
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('observasi/formobservasi', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  public function jawabansupersub($tb_observasi_super_sub_id, $tb_dataanak_id)
  {
    $supersubid = $this->encryptor->enkrip('dekrip', $tb_observasi_super_sub_id);
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $this->form_validation->set_rules('nilai', 'Nilai', 'required');
    $this->form_validation->set_rules('catatan', 'Catatan', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Gagal Menyimpan Data');
      redirect('observasi/formobservasi/' . $tb_dataanak_id);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_sub_super_id' => $supersubid,
        'tb_dataanak_id' => $anakid,
        'tb_jawaban_nilai' => $input['nilai'],
        'tb_jawaban_catatan' => $input['catatan'],
        'tb_jawaban_tanggal' => date('Y-m-d'),
      ];
      $this->obs->saveJawaban($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Berhasil Menyimpan Data');
      redirect('observasi/formobservasi/' . $tb_dataanak_id);
    }
  }

  public function jawabansub($tb_observasi_sub_id, $tb_dataanak_id)
  {
    $subid = $this->encryptor->enkrip('dekrip', $tb_observasi_sub_id);
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $this->form_validation->set_rules('nilai', 'Nilai', 'required');
    $this->form_validation->set_rules('catatan', 'Catatan', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Gagal Menyimpan Data');
      redirect('observasi/formobservasi/' . $tb_dataanak_id);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_sub_id' => $subid,
        'tb_dataanak_id' => $anakid,
        'tb_jawaban_nilai' => $input['nilai'],
        'tb_jawaban_catatan' => $input['catatan'],
        'tb_jawaban_tanggal' => date('Y-m-d'),
      ];
      $this->obs->saveJawaban($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Berhasil Menyimpan Data');
      redirect('observasi/formobservasi/' . $tb_dataanak_id);
    }
  }

  public function editnama($tb_dataanak_id)
  {
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $this->form_validation->set_rules('panggilan', 'Panggilan', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Gagal Menyimpan Data');
      redirect('observasi/formobservasi/' . $tb_dataanak_id);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_dataanak_nama_panggilan' => $input['panggilan'],
      ];
      $this->bj->editAnak($anakid, $dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Berhasil Menyimpan Data');
      redirect('observasi/formobservasi/' . $tb_dataanak_id);
    }
  }

  public function siswaditerima($tb_dataanak_id)
  {
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $dataanak = $this->bj->getDataanak($anakid);
    $dataisi = [
      'tb_dataanak_statusditerima' => 1
    ];
    $this->bj->editAnak($anakid, $dataisi);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Calon Siswa Bernama ' . $dataanak['tb_dataanak_nama_anak'] . ' Telah Diterima');
    redirect('observasi');
  }

  public function downloadobservasi($tb_dataanak_id)
  {
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $data['dataanak'] = $this->bj->getDataanak($anakid);
    $data['aktif'] = $this->obs->getAktif($data['dataanak']['tb_dataanak_tahun']);
    $data['dataobservasi'] = $this->obs->getObservasi();
    $this->load->library('Pdf');
    $this->load->view('cetak/observer_observasi', $data);
  }

  public function riwayat()
  {
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Observasi PPDB';
    $data['submenu'] = 'Riwayat Observasi';
    $data['supersubmenu'] = 'Riwayat Observasi';
    $data['dataanak'] = $this->bj->getDataanakbytahun();
    $this->load->view('templates/dashboard_header', $data);
    $this->load->view('keuangan/riwayatppdb', $data);
    $this->load->view('templates/dashboard_footer', $data);
  }

  // public function downloadobservasiot($tb_dataanak_id)
  // {
  //   $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
  //   $data['dataanak'] = $this->bj->getDataanak($anakid);
  //   $data['aktif'] = $this->obs->getAktif($data['dataanak']['tb_dataanak_tahun']);
  //   $data['dataanak'] = $this->bj->getDataanak($anakid);
  //   $data['orangtua'] = $this->db->get_where('tb_orangtua', ['user_id' => $data['userku']['user_id']])->row_array();
  //   $data['formot'] = $this->db->get_where('tb_observasi_ot', ['is_active' => 1])->result_array();
  //   $this->load->library('Pdf');
  //   $this->load->view('cetak/observer_observasiot', $data);
  // }

  public function downloadobservasiot($tb_dataanak_id)
  {
    $data['menu'] = 'Observasi PPDB';
    $data['submenu'] = 'Riwayat Observasi';
    $data['supersubmenu'] = 'Riwayat Observasi';
    $data['user'] = $this->usr->getUserlog();
    $anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
    $data['dataanak'] = $this->bj->getDataanak($anakid);
    $data['formot'] = $this->db->get_where('tb_observasi_ot', ['is_active' => 1])->result_array();
    $data['title'] = 'Data Siswa';
    // $this->load->view('templates/dashboard_header', $data);
    // $this->load->view('cetak/', $data);
    // $this->load->view('templates/dashboard_footer');
    $this->load->library('Pdf');
    $this->load->view('cetak/observer_observasiot', $data);
  }
}
