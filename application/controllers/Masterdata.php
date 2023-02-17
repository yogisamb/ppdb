<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sistem_model', 'sis');
    $this->load->model('User_model', 'usr');
    $this->load->model('Bintangjuara_model', 'bj');
    is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[tb_sekolah.tb_sekolah_title]');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
    $this->form_validation->set_rules('kotakabupaten', 'Kotakabupaten', 'required');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');
    $this->form_validation->set_rules('telp', 'Telp', 'required');
    if ($this->form_validation->run() == false) {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Master Data';
      $data['submenu'] = 'Data Sekolah';
      $data['supersubmenu'] = 'Data Sekolah';
      $data['datasekolah'] = $this->bj->getSekolah();
      $data['provinsi'] = $this->usr->getProvinsi();
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('masterdata/datasekolah', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_sekolah_title' => $input['nama'],
        'tb_sekolah_alamat' => $input['alamat'],
        'tb_provinsi_id' => $input['provinsi'],
        'tb_kabupaten_kota_id' => $input['kotakabupaten'],
        'tb_kecamatan_id' => $input['kecamatan'],
        'tb_kelurahan_id' => $input['kelurahan'],
        'tb_sekolah_telp' => $input['telp'],
      ];
      $this->bj->saveSekolah($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Sekolah berhasil Ditambah');
      redirect('masterdata');
    }
  }

  public function editsekolah($tb_sekolah_id)
  {
    $this->form_validation->set_rules('nama', 'Nama');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
    $this->form_validation->set_rules('kotakabupaten', 'Kotakabupaten', 'required');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');
    $this->form_validation->set_rules('telp', 'Telp', 'required');
    $sekolahid = $this->encryptor->enkrip('dekrip', $tb_sekolah_id);
    if ($this->form_validation->run() == false) {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Master Data';
      $data['submenu'] = 'Data Sekolah';
      $data['supersubmenu'] = 'Data Sekolah';
      $data['datasekolah'] = $this->bj->getSekolah($sekolahid);
      $data['provinsi'] = $this->usr->getProvinsi();
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('masterdata/editsekolah', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_sekolah_title' => $input['nama'],
        'tb_sekolah_alamat' => $input['alamat'],
        'tb_provinsi_id' => $input['provinsi'],
        'tb_kabupaten_kota_id' => $input['kotakabupaten'],
        'tb_kecamatan_id' => $input['kecamatan'],
        'tb_kelurahan_id' => $input['kelurahan'],
        'tb_sekolah_telp' => $input['telp'],
      ];
      $this->bj->editSekolah($sekolahid, $dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Sekolah berhasil Diubah');
      redirect('masterdata');
    }
  }

  public function tahunajaran()
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('awal', 'Awal', 'required');
    $this->form_validation->set_rules('akhir', 'Akhir', 'required');

    if ($this->form_validation->run() == false) {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Master Data';
      $data['submenu'] = 'Tahun Ajaran';
      $data['supersubmenu'] = 'Tahun Ajaran';
      $data['tahunajaran'] = $this->bj->getTahunajaran();
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('masterdata/tahunajaran', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_tahun_title' => $input['title'],
        'tb_tahun_awal' => $input['awal'],
        'tb_tahun_akhir' => $input['akhir'],
      ];
      $this->bj->saveTahunajaran($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Tahun Ajaran Berhasil di Tambah');
      redirect('masterdata/tahunajaran');
    }
  }

  public function edittahunajaran($tb_tahun_id)
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('awal', 'Awal', 'required');
    $this->form_validation->set_rules('akhir', 'Akhir', 'required');
    $tahunid = $this->encryptor->enkrip('dekrip', $tb_tahun_id);
    if ($this->form_validation->run() == false) {
      $data['user'] = $this->usr->getUserlog();
      $data['menu'] = 'Master Data';
      $data['submenu'] = 'Tahun Ajaran';
      $data['supersubmenu'] = 'Tahun Ajaran';
      $data['tahunajaran'] = $this->bj->getTahunajaran($tahunid);
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('masterdata/edittahunajaran', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_tahun_title' => $input['title'],
        'tb_tahun_awal' => $input['awal'],
        'tb_tahun_akhir' => $input['akhir'],
      ];
      $this->bj->editTahunajaran($tahunid, $dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Tahun Ajaran Berhasil Dirubah');
      redirect('masterdata/tahunajaran');
    }
  }

  public function isaktiftahunajaran($tb_tahun_id)
  {
    $tahunid = $this->encryptor->enkrip('dekrip', $tb_tahun_id);
    $tahunajaran = $this->bj->getTahunajaran($tahunid);
    if ($tahunajaran['is_active'] == 1) {
      $dataisi = [
        'is_active' => 0
      ];
      $this->bj->editTahunajaran($tahunid, $dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Gelombang PPDB berhasil diubah');
    } else {
      $cektahun = $this->bj->getTahunaktif();
      if ($cektahun) {
        $this->session->set_flashdata('message1', 'error');
        $this->session->set_flashdata('message2', 'Masih Ada Gelombang PPDB yang aktif');
      } else {
        $dataisi = [
          'is_active' => 1
        ];
        $this->bj->editTahunajaran($tahunid, $dataisi);
        $this->session->set_flashdata('message1', 'success');
        $this->session->set_flashdata('message2', 'Gelombang PPDB berhasil diubah');
      }
    }
    redirect('masterdata/tahunajaran');
  }

  public function observasi()
  {
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Master Data';
    $data['submenu'] = 'Master Observasi';
    $data['supersubmenu'] = 'Master Observasi';
    $data['dataobservasi'] = $this->bj->getObservasi();
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('masterdata/dataobservasi', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_title' => $input['nama'],
      ];
      $this->bj->saveObservasi($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Observasi Berhasil ditambah');
      redirect('masterdata/observasi');
    }
  }

  public function tambahobservasisub($tb_observasi_id)
  {
    $observasiid = $this->encryptor->enkrip('dekrip', $tb_observasi_id);
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Data Sub Observasi Gagal Ditambah');
      redirect('masterdata/observasi');
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_id' => $observasiid,
        'tb_observasi_sub_title' => $input['nama'],
        'is_active' => 1
      ];
      $this->bj->saveObservasisub($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Sub Observasi Berhasil ditambah');
      redirect('masterdata/observasi');
    }
  }

  public function editobservasi($tb_observasi_id)
  {
    $observasiid = $this->encryptor->enkrip('dekrip', $tb_observasi_id);
    $data['user'] = $this->usr->getUserlog();
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Data Observasi Gagal Diubah');
      redirect('masterdata/observasi');
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_title' => $input['nama'],
      ];
      $this->bj->editobservasi($dataisi, $observasiid);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Observasi Berhasil diubah');
      redirect('masterdata/observasi');
    }
  }

  public function isactiveobservasi($tb_observasi_id)
  {
    $observasiid = $this->encryptor->enkrip('dekrip', $tb_observasi_id);
    $dataobservasi = $this->bj->getObservasi($observasiid);
    if ($dataobservasi['is_active'] == 0) {
      $dataisi = [
        'is_active' => 1,
      ];
    } else {
      $dataisi = [
        'is_active' => 0,
      ];
    }
    $this->bj->editObservasi($dataisi, $observasiid);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Data Observasi Berhasil diubah');
    redirect('masterdata/observasi');
  }

  public function isactiveso($tb_observasi_sub_id)
  {
    $observasisubid = $this->encryptor->enkrip('dekrip', $tb_observasi_sub_id);
    $observasisub = $this->bj->getSubobservasi($observasisubid);
    if ($observasisub['is_active'] == 1) {
      $dataisi = [
        'is_active' => 0,
      ];
    } else {
      $dataisi = [
        'is_active' => 1,
      ];
    }
    $this->bj->editSubobservasi($dataisi, $observasisubid);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Data Sub Observasi Berhasil diubah');
    redirect('masterdata/observasi');
  }

  public function editsubobservasi($tb_observasi_sub_id)
  {
    $subobservasiid = $this->encryptor->enkrip('dekrip', $tb_observasi_sub_id);
    $data['user'] = $this->usr->getUserlog();
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Data Sub Observasi Gagal Diubah');
      redirect('masterdata/observasi');
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_sub_title' => $input['nama'],
      ];
      $this->bj->editSubobservasi($dataisi, $subobservasiid);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Sub Observasi Berhasil diubah');
      redirect('masterdata/observasi');
    }
  }

  public function supersubobservasi($tb_observasi_sub_id)
  {
    $subobservasiid = $this->encryptor->enkrip('dekrip', $tb_observasi_sub_id);
    $data['user'] = $this->usr->getUserlog();
    $data['menu'] = 'Master Data';
    $data['submenu'] = 'Master Observasi';
    $data['supersubmenu'] = 'Master Observasi';
    $data['supersubobservasi'] = $this->bj->getSupersubobservasibysubobservasiid($subobservasiid);
    $data['subobservasi'] = $this->bj->getSubobservasi($subobservasiid);
    $data['observasi'] = $this->bj->getObservasi($data['subobservasi']['tb_observasi_id']);
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/dashboard_header', $data);
      $this->load->view('masterdata/datasupersubobservasi', $data);
      $this->load->view('templates/dashboard_footer', $data);
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_sub_id' => $subobservasiid,
        'tb_observasi_sub_super_title' => $input['nama'],
        'is_active' => 1
      ];
      $this->bj->saveSupersubobvervasi($dataisi);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Super Sub Observasi Berhasil ditambah');
      redirect('masterdata/supersubobservasi/' . $tb_observasi_sub_id);
    }
  }

  public function isactivesso($tb_observasi_sub_super_id)
  {
    $observasisupersubid = $this->encryptor->enkrip('dekrip', $tb_observasi_sub_super_id);
    $observasisupersub = $this->bj->getSupersubobservasi($observasisupersubid);
    if ($observasisupersub['is_active'] == 1) {
      $dataisi = [
        'is_active' => 0,
      ];
    } else {
      $dataisi = [
        'is_active' => 1,
      ];
    }
    $this->bj->editSupersubobservasi($dataisi, $observasisupersubid);
    $this->session->set_flashdata('message1', 'success');
    $this->session->set_flashdata('message2', 'Data Super Sub Observasi Berhasil diubah');
    redirect('masterdata/supersubobservasi/' . $this->encryptor->enkrip('enkrip', $observasisupersub['tb_observasi_sub_id']));
  }

  public function editsupersubobservasi($tb_observasi_sub_super_id)
  {
    $supersubobservasiid = $this->encryptor->enkrip('dekrip', $tb_observasi_sub_super_id);
    $observasisupersub = $this->bj->getSupersubobservasi($supersubobservasiid);
    $data['user'] = $this->usr->getUserlog();
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message1', 'error');
      $this->session->set_flashdata('message2', 'Data Super Sub Observasi Gagal Diubah');
      redirect('masterdata/observasi');
    } else {
      $input = $this->input->post(null, true);
      $dataisi = [
        'tb_observasi_sub_super_title' => $input['nama'],
      ];
      $this->bj->editSupersubobservasi($dataisi, $supersubobservasiid);
      $this->session->set_flashdata('message1', 'success');
      $this->session->set_flashdata('message2', 'Data Super Sub Observasi Berhasil diubah');
      redirect('masterdata/supersubobservasi/' . $this->encryptor->enkrip('enkrip', $observasisupersub['tb_observasi_sub_id']));
    }
  }
}
