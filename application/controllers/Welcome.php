<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
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
		$this->load->model('Sistem_model', 'sis');
		$this->load->model('Observasi_model', 'obs');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title'] = 'Beranda';
		$this->load->view('templates/landingpage_header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/landingpage_footer');
	}

	public function pendaftaran()
	{
		if ($this->usr->getUserlog()) {
			redirect('welcome/datacalonsiswa');
		}
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.user_email]', [
			'is_unique' => 'This email is already registered!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]', [
			'min_length' => 'Password too short!'
		]);
		$data['title'] = 'Pendaftaran';
		$this->form_validation->set_rules('t', 'T', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('kotakabupaten', 'Kotakabupaten', 'required');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');
		$this->form_validation->set_rules('namalengkap', 'Namalengkap', 'required');
		$this->form_validation->set_rules('tl', 'Tl', 'required');
		$this->form_validation->set_rules('jk', 'Jk', 'required');
		$this->form_validation->set_rules('asalsekolah', 'Asalsekolah', 'required');
		$this->form_validation->set_rules('namaayah', 'Namaayah', 'required');
		$this->form_validation->set_rules('telpayah', 'Telpayah', 'required');
		$this->form_validation->set_rules('pekerjaanayah', 'Pekerjaanayah', 'required');
		$this->form_validation->set_rules('umurayah', 'Umurayah', 'required');
		$this->form_validation->set_rules('namaibu', 'Namaibu', 'required');
		$this->form_validation->set_rules('telpibu', 'Telpibu', 'required');
		$this->form_validation->set_rules('pekerjaanibu', 'Pekerjaanibu', 'required');
		$this->form_validation->set_rules('umuribu', 'Umuribu', 'required');
		$this->form_validation->set_rules('informasi', 'Informasi', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('keterangan_lain', 'Keterangan_lain', 'required');
		$this->form_validation->set_rules('jadwal', 'Jadwal', 'required');
		if ($this->form_validation->run() == false) {
			$data['provinsi'] = $this->usr->getProvinsi();
			$data['sekolah'] = $this->db->get('tb_sekolah')->result_array();
			$this->load->view('templates/landingpage_header', $data);
			$cektahun = $this->bj->getTahunaktif();
			if ($cektahun) {
				$this->load->view('home/pendaftaran', $data);
			} else {
				$this->load->view('home/pendaftaranditutup', $data);
			}
			$this->load->view('templates/landingpage_footer');
		} else {
			$input = $this->input->post(null, true);

			// upload File
			$upload_file = $_FILES['file'];
			if ($upload_file['name'] == null) {
				$new_name = '';
			} else {
				$config['allowed_types'] = 'zip|rar|jpg|jpeg|png|pdf|cdr';
				$config['upload_path']   = './assets/files/kebutuhankhusus/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$upload_data = $this->upload->data();
					$nama_random = 'kebutuhankhusus';
					$path = $upload_data['file_path'];
					$old_name = $upload_data['raw_name'] . $upload_data['file_ext'];
					$angka_acak = mt_rand();
					$new_name = $nama_random  . '_' . $input['namalengkap'] . '_' . $angka_acak . $upload_data['file_ext'];
					rename($path . $old_name, $path . $new_name); // ganti nama image dengan nama & id_event
				} else {
					$error =  $this->upload->display_errors();
					$this->session->set_flashdata('message1', 'error');
					$this->session->set_flashdata('message2', '' . $error . '');
					redirect('welcome');
				}
			}

			// cek Sekolah Baru Atau Tidak
			if ($input['asalsekolah'] == "pilihsekolah") {
				if ($input['manual'] == null) {
					$this->session->set_flashdata('message1', 'error');
					$this->session->set_flashdata('message2', 'Nama sekolah tidak boleh kosong');
					redirect('welcome/pendaftaran');
				}

				// insert sekolah baru
				$dataisi = [
					'tb_sekolah_title' => $input['manual'],
					'tb_sekolah_alamat' => null,
					'tb_provinsi_id' => null,
					'tb_kabupaten_kota_id' => null,
					'tb_kecamatan_id' => null,
					'tb_kelurahan_id' => null,
					'tb_sekolah_telp' => null,
				];
				$this->db->insert('tb_sekolah', $dataisi);
				$idsekolah = $this->db->insert_id();

				// notifikasi
				$datanotif = [
					'tb_notifikasi_title' => 'Data Sekolah Baru',
					'tb_notifikasi_subtitle' => 'Walisiswa Menginputkan Data Sekolag Baru',
					'tb_notifikasi_icon' => 'grid',
					'tb_notifikasi_color' => 'info',
					'user_sub_menu_id' => 6,
					'tb_notifikasi_date_created' => date('Y-m-d H:m:s'),
				];
				$this->bj->saveNotifikasi($datanotif);

				$sekolah = $idsekolah;
			} else {
				$sekolah = $input['asalsekolah'];
			}
			$cektahunaktif = $this->bj->getTahunaktifrow();

			// Upload Data Anak
			$dataisi = [
				"tb_dataanak_tahun" => $cektahunaktif['tb_tahun_id'],
				"tb_dataanak_create" => date('Y-m-d'),
				"tb_dataanak_nama_anak" => $input['namalengkap'],
				"tb_dataanak_alamat" => $input['alamat'],
				"tb_dataanak_provinsi" => $input['provinsi'],
				"tb_dataanak_kabupatenkota" => $input['kotakabupaten'],
				"tb_dataanak_kecamatan" => $input['kecamatan'],
				"tb_dataanak_kelurahan" => $input['kelurahan'],
				"tb_dataanak_tempat" => $input['t'],
				"tb_dataanak_tanggal_lahir" => $input['tl'],
				"tb_dataanak_jk" => $input['jk'],
				"tb_dataanak_asal_sekolah" => $sekolah,
				"tb_dataanak_informasi" => $input['informasi'],
				"tb_dataanak_keterangan" => $input['keterangan'],
				"tb_dataanak_keterangan_lain" => $input['keterangan_lain'],
				"tb_dataanak_jadwal" => $input['jadwal'],
				"tb_dataanak_files" => $new_name
			];
			$this->db->insert('tb_dataanak', $dataisi);
			$idanak = $this->db->insert_id();

			// Upload Data Login User Orang Tua
			$datauser = [
				'user_profile' => $input['namaayah'],
				'user_name' => $input['namaayah'],
				'user_email' => $input['email'],
				'user_role_id' => '9',
				'user_password' => password_hash($input['password'], PASSWORD_DEFAULT),
				'user_password_mask' => $this->encryptor->enkrip('enkrip', $input['password']),
				'is_active' => 0,
				'user_date_created' => date('Y/m/d')
			];
			$this->db->insert('user', $datauser);
			$idorangtua = $this->db->insert_id();

			// Upload Data Orang Tua
			$dataorangtua = [
				"user_id" => $idorangtua,
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

			// Upload Data Token Login Orang Tua
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $input['email'],
				'token' => $token,
				'date_created' => time()
			];
			$this->db->insert('user_token', $user_token);

			// Upload relasi Orang Tua dan Anak
			$datarelasi = [
				'user_id' => $idorangtua,
				'tb_dataanak_id' => $idanak,
				'tb_tahun_id' => $cektahunaktif['tb_tahun_id'],
			];
			$this->db->insert('tb_relasi_anak', $datarelasi);

			$datanotif = [
				'tb_notifikasi_title' => 'Data PPDB Baru',
				'tb_notifikasi_subtitle' => 'Ada Data PPDB Baru',
				'tb_notifikasi_icon' => 'tag',
				'tb_notifikasi_color' => 'success',
				'user_sub_menu_id' => 8,
				'tb_notifikasi_date_created' => date('Y-m-d H:m:s'),
			];
			$this->bj->saveNotifikasi($datanotif);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message1', 'success');
			$this->session->set_flashdata('message2', 'Pembuatan Akun dan Pendaftaran Berhasil. Silahkan Cek Email untuk Aktivasi Akun');
			redirect('welcome');
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
		$this->email->from($emailconfig['tb_config_email_text'], 'PPDB Bintang Juara');

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
            <h4 style="text-align: center">Copyright &#169;' . date('Y') . ' All rights reserved - Akademik Bintang Juara</h4>
          </div>
        </div>
      ');
		} else if ($type == "forgot") {
			$user = $this->usr->getUserdetail($userid);
			$mask = $this->encryptor->enkrip('dekrip', $user['user_password_mask']);
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
                  <td style="font-weight: bold;">Email</td>
                  <td style="font-weight: bold;">: ' . $user['user_email'] . '</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">Username</td>
                  <td style="font-weight: bold;">: ' . $user['user_name'] . '</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">Password</td>
                  <td style="font-weight: bold;">: ' . $mask . '</td>
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

	public function datacalonsiswa()
	{
		if (!$this->usr->getUserlog()) {
			redirect('welcome');
		}
		$userku = $this->usr->getUserlog();
		$data['tahun'] = $this->db->Order_by('tb_tahun_title', 'DESC');
		$data['tahun'] = $this->db->get('tb_tahun')->result_array();
		$data['orangtua'] = $this->db->get_where('tb_orangtua', ['user_id' => $userku['user_id']])->row_array();
		$data['title'] = 'Data Siswa';
		$this->load->view('templates/landingpage_header', $data);
		$this->load->view('home/datacalonsiswa', $data);
		$this->load->view('templates/landingpage_footer');
	}

	public function tahuncalonsiswa($tb_tahun_id)
	{
		$tahunid = $this->encryptor->enkrip('dekrip', $tb_tahun_id);
		$data['user'] = $this->usr->getUserlog();

		if (!$this->usr->getUserlog()) {
			redirect('welcome');
		}
		$userku = $this->usr->getUserlog();
		$data['orangtua'] = $this->db->get_where('tb_orangtua', ['user_id' => $userku['user_id']])->row_array();
		$data['relasianak'] = $this->db->get_where('tb_relasi_anak', ['user_id' => $userku['user_id'], 'tb_tahun_id' => $tahunid])->result_array();
		$data['tahuntitle'] = $this->bj->getTahunaktifrow();
		$data['tahun'] = $tahunid;
		$data['title'] = 'Data Siswa';
		$this->load->view('templates/landingpage_header', $data);
		$this->load->view('home/tahuncalonsiswa', $data);
		$this->load->view('templates/landingpage_footer');
	}

	public function tambahcalonsiswa()
	{
		$this->form_validation->set_rules('t', 'T', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('namalengkap', 'Namalengkap', 'required');
		$this->form_validation->set_rules('tl', 'Tl', 'required');
		$this->form_validation->set_rules('jk', 'Jk', 'required');
		$this->form_validation->set_rules('asalsekolah', 'Asalsekolah', 'required');
		$this->form_validation->set_rules('informasi', 'Informasi', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('keterangan_lain', 'Keterangan_lain', 'required');
		if ($this->form_validation->run() == false) {
			if (!$this->usr->getUserlog()) {
				redirect('welcome');
			}
			$data['provinsi'] = $this->usr->getProvinsi();
			$data['sekolah'] = $this->db->get('tb_sekolah')->result_array();
			$data['title'] = 'Data Siswa';
			$this->load->view('templates/landingpage_header', $data);
			$this->load->view('home/tambahcalonsiswa', $data);
			$this->load->view('templates/landingpage_footer');
		} else {
			$input = $this->input->post(null, true);
			// upload File
			$upload_file = $_FILES['file'];
			if ($upload_file['name'] == null) {
				$new_name = '';
			} else {
				$config['allowed_types'] = 'zip|rar|jpg|jpeg|png|pdf|cdr';
				$config['upload_path']   = './assets/files/kebutuhankhusus/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$upload_data = $this->upload->data();
					$nama_random = 'kebutuhankhusus';
					$path = $upload_data['file_path'];
					$old_name = $upload_data['raw_name'] . $upload_data['file_ext'];
					$angka_acak = mt_rand();
					$new_name = $nama_random  . '_' . $input['namalengkap'] . '_' . $angka_acak . $upload_data['file_ext'];
					rename($path . $old_name, $path . $new_name); // ganti nama image dengan nama & id_event
				} else {
					$error =  $this->upload->display_errors();
					$this->session->set_flashdata('message1', 'error');
					$this->session->set_flashdata('message2', '' . $error . '');
					redirect('welcome/tambahcalonsiswa');
				}
			}
			if ($input['asalsekolah'] == "pilihsekolah") {
				if ($input['manual'] == null) {
					$this->session->set_flashdata('message1', 'error');
					$this->session->set_flashdata('message2', 'Nama sekolah tidak boleh kosong');
					redirect('welcome/tambahcalonsiswa');
				}

				// insert sekolah baru
				$dataisi = [
					'tb_sekolah_title' => $input['manual'],
					'tb_sekolah_alamat' => null,
					'tb_provinsi_id' => null,
					'tb_kabupaten_kota_id' => null,
					'tb_kecamatan_id' => null,
					'tb_kelurahan_id' => null,
					'tb_sekolah_telp' => null,
				];
				$this->db->insert('tb_sekolah', $dataisi);
				$idsekolah = $this->db->insert_id();

				// notifikasi
				$datanotif = [
					'tb_notifikasi_title' => 'Data Sekolah Baru',
					'tb_notifikasi_subtitle' => 'Walisiswa Menginputkan Data Sekolag Baru',
					'tb_notifikasi_icon' => 'grid',
					'tb_notifikasi_color' => 'info',
					'user_sub_menu_id' => 6,
					'tb_notifikasi_date_created' => date('Y-m-d H:m:s'),
				];
				$this->bj->saveNotifikasi($datanotif);

				$sekolah = $idsekolah;
			} else {
				$sekolah = $input['asalsekolah'];
			}
			$cektahunaktif = $this->bj->getTahunaktifrow();

			$dataisi = [
				"tb_dataanak_tahun" => $cektahunaktif['tb_tahun_id'],
				"tb_dataanak_create" => date('Y-m-d'),
				"tb_dataanak_nama_anak" => $input['namalengkap'],
				"tb_dataanak_alamat" => $input['alamat'],
				"tb_dataanak_provinsi" => $input['provinsi'],
				"tb_dataanak_kabupatenkota" => $input['kotakabupaten'],
				"tb_dataanak_kecamatan" => $input['kecamatan'],
				"tb_dataanak_kelurahan" => $input['kelurahan'],
				"tb_dataanak_tempat" => $input['t'],
				"tb_dataanak_tanggal_lahir" => $input['tl'],
				"tb_dataanak_jk" => $input['jk'],
				"tb_dataanak_asal_sekolah" => $sekolah,
				"tb_dataanak_informasi" => $input['informasi'],
				"tb_dataanak_keterangan" => $input['keterangan'],
				"tb_dataanak_keterangan_lain" => $input['keterangan_lain'],
				"tb_dataanak_jadwal" => $input['jadwal'],
				"tb_dataanak_files" => $new_name
			];
			$this->db->insert('tb_dataanak', $dataisi);
			$idanak = $this->db->insert_id();
			$idorangtua = $this->usr->getUserlog();
			$datarelasi = [
				'user_id' => $idorangtua['user_id'],
				'tb_dataanak_id' => $idanak,
				'tb_tahun_id' => $cektahunaktif['tb_tahun_id'],
			];
			$this->db->insert('tb_relasi_anak', $datarelasi);

			$datanotif = [
				'tb_notifikasi_title' => 'Data PPDB Baru',
				'tb_notifikasi_subtitle' => 'Ada Data PPDB Baru',
				'tb_notifikasi_icon' => 'tag',
				'tb_notifikasi_color' => 'success',
				'user_sub_menu_id' => 8,
				'tb_notifikasi_date_created' => date('Y-m-d H:m:s'),
			];
			$this->bj->saveNotifikasi($datanotif);

			$this->session->set_flashdata('message1', 'success');
			$this->session->set_flashdata('message2', 'Pembuatan Akun dan Pendaftaran Berhasil. Silahkan Cek Email untuk Aktivasi Akun');
			redirect('welcome/tahuncalonsiswa/' . $this->encryptor->enkrip('enkrip', $cektahunaktif['tb_tahun_id']));
		}
	}

	public function editcalonsiswa($tb_dataanak_id)
	{
		$dataanakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
		$data['provinsi'] = $this->usr->getProvinsi();
		$data['sekolah'] = $this->db->get('tb_sekolah')->result_array();
		$data['title'] = 'Data Siswa';
		$data['calonsiswa'] = $this->db->get_where('tb_dataanak', ['tb_dataanak_id' => $dataanakid])->row_array();
		$data['asalsekolah'] = $this->bj->getSekolah($data['calonsiswa']['tb_dataanak_asal_sekolah']);
		$this->form_validation->set_rules('t', 'T', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('namalengkap', 'Namalengkap', 'required');
		$this->form_validation->set_rules('tl', 'Tl', 'required');
		$this->form_validation->set_rules('jk', 'Jk', 'required');
		$this->form_validation->set_rules('asalsekolah', 'Asalsekolah', 'required');
		$this->form_validation->set_rules('keterangan_lain', 'Keterangan_lain', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/landingpage_header', $data);
			$this->load->view('home/editcalonsiswa', $data);
			$this->load->view('templates/landingpage_footer');
		} else {
			$input = $this->input->post(null, true);
			$dataisi = [
				"tb_dataanak_nama_anak" => $input['namalengkap'],
				"tb_dataanak_alamat" => $input['alamat'],
				"tb_dataanak_tempat" => $input['t'],
				"tb_dataanak_tanggal_lahir" => $input['tl'],
				"tb_dataanak_jk" => $input['jk'],
				"tb_dataanak_asal_sekolah" => $input['asalsekolah'],
				"tb_dataanak_keterangan_lain" => $input['keterangan_lain']
			];

			$this->db->where('tb_dataanak_id', $dataanakid);
			$this->db->update('tb_dataanak', $dataisi);

			$this->session->set_flashdata('message1', 'success');
			$this->session->set_flashdata('message2', 'Berhasil Menyimpan Data');
			redirect('welcome/tahuncalonsiswa/' . $this->encryptor->enkrip('enkrip', $data['calonsiswa']['tb_dataanak_tahun']));
		}
	}

	public function uploadpembayaran($tb_tahun_id, $tb_dataanak_id)
	{
		$tahun = $this->encryptor->enkrip('dekrip', $tb_tahun_id);
		$dataanakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
		$userku = $this->usr->getUserlog();
		$upload_file = $_FILES['file'];

		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['upload_path']   = './assets/files/pembayaran/';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file')) {
			$upload_data = $this->upload->data();
			$nama_random = 'bukti_pembayaran';
			$path = $upload_data['file_path'];
			$old_name = $upload_data['raw_name'] . $upload_data['file_ext'];
			$angka_acak = mt_rand();
			$new_name = $nama_random  . '_' . $userku['user_id'] . '_' . $tahun . '_' . $angka_acak . $upload_data['file_ext'];
			rename($path . $old_name, $path . $new_name); // ganti nama image dengan nama & id_event
		} else {
			$error =  $this->upload->display_errors();
			$this->session->set_flashdata('message1', 'error');
			$this->session->set_flashdata('message2', '' . $error . '');
			redirect('welcome/tahuncalonsiswa/' . $tb_tahun_id);
		}
		$dataisi = [
			'tb_tahun_id' => $tahun,
			'user_id' => $userku['user_id'],
			'tb_dataanak_id' => $dataanakid,
			'tb_pembayaran_status' => 0,
			'tb_pembayaran_file' => $new_name
		];
		$this->db->insert('tb_pembayaran', $dataisi);

		$datanotif = [
			'tb_notifikasi_title' => 'Pembayaran Baru',
			'tb_notifikasi_subtitle' => 'Wali Melakukan Pembayaran Baru',
			'tb_notifikasi_icon' => 'tag',
			'tb_notifikasi_color' => 'success',
			'user_sub_menu_id' => 8,
			'tb_notifikasi_date_created' => date('Y-m-d H:m:s'),
		];
		$this->bj->saveNotifikasi($datanotif);

		$this->session->set_flashdata('message1', 'success');
		$this->session->set_flashdata('message2', 'Upload Bukti Pembayaran berhasil');
		redirect('welcome/tahuncalonsiswa/' . $tb_tahun_id);
	}

	public function editorangtua()
	{
		$this->form_validation->set_rules('namaayah', 'Namaayah', 'required');
		$this->form_validation->set_rules('telpayah', 'Telpayah', 'required');
		$this->form_validation->set_rules('pekerjaanayah', 'Pekerjaanayah', 'required');
		$this->form_validation->set_rules('umurayah', 'Umurayah', 'required');
		$this->form_validation->set_rules('namaibu', 'Namaibu', 'required');
		$this->form_validation->set_rules('telpibu', 'Telpibu', 'required');
		$this->form_validation->set_rules('pekerjaanibu', 'Pekerjaanibu', 'required');
		$this->form_validation->set_rules('umuribu', 'Umuribu', 'required');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('message1', 'error');
			$this->session->set_flashdata('message2', 'Data Gagal Disimpan, Cek Form Inputan');
			redirect('welcome/datacalonsiswa');
		} else {
			$input = $this->input->post(null, true);
			$userku = $this->usr->getUserlog();
			$dataorangtua = [
				"tb_dataanak_nama_ayah" => $input['namaayah'],
				"tb_dataanak_telp_ayah" => $input['telpayah'],
				"tb_dataanak_pekerjaan_ayah" => $input['pekerjaanayah'],
				"tb_dataanak_umur_ayah" => $input['umurayah'],
				"tb_dataanak_nama_ibu" => $input['namaibu'],
				"tb_dataanak_telp_ibu" => $input['telpibu'],
				"tb_dataanak_pekerjaan_ibu" => $input['pekerjaanibu'],
				"tb_dataanak_umur_ibu" => $input['umuribu'],
			];
			$this->db->where('user_id', $userku['user_id']);
			$this->db->update('tb_orangtua', $dataorangtua);
			$this->session->set_flashdata('message1', 'success');
			$this->session->set_flashdata('message2', 'Data Wali Siswa Sukses diubah!');
			redirect('welcome/datacalonsiswa');
		}
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

	public function downloadobservasi($tb_dataanak_id)
	{
		$anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
		$data['dataanak'] = $this->bj->getDataanak($anakid);
		$data['aktif'] = $this->obs->getAktif($data['dataanak']['tb_dataanak_tahun']);
		$data['dataobservasi'] = $this->obs->getObservasi();
		$this->load->library('Pdf');
		$this->load->view('cetak/observer_observasi', $data);
	}

	public function uploadformobservasi($tb_dataanak_id)
	{
		if (!$this->usr->getUserlog()) {
			redirect('welcome');
		}
		$data['userku'] = $this->usr->getUserlog();
		$anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
		$data['dataanak'] = $this->bj->getDataanak($anakid);
		$data['orangtua'] = $this->db->get_where('tb_orangtua', ['user_id' => $data['userku']['user_id']])->row_array();
		$data['formot'] = $this->db->get_where('tb_observasi_ot', ['is_active' => 1])->result_array();
		$data['title'] = 'Data Siswa';
		$this->load->view('templates/landingpage_header', $data);
		$this->load->view('home/formot', $data);
		$this->load->view('templates/landingpage_footer');
	}

	public function simpanformot($tb_dataanak_id)
	{
		$this->form_validation->set_rules('jmlsdr', 'Jmlsdr', 'required');
		$this->form_validation->set_rules('anakke', 'Anakke', 'required');
		$this->form_validation->set_rules('agama', 'Agama', 'required');
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('message1', 'error');
			$this->session->set_flashdata('message2', 'Data tidak boleh kosong');
			redirect('welcome/uploadformobservasi/' . $tb_dataanak_id);
		} else {
			$anakid = $this->encryptor->enkrip('dekrip', $tb_dataanak_id);
			$data['dataanak'] = $this->bj->getDataanak($anakid);
			$input = $this->input->post(null, true);
			$dataisi = [
				'tb_dataanak_agama' => $input['agama'],
				'tb_dataanak_anakke' => $input['anakke'],
				'tb_dataanak_jmlsdr' => $input['jmlsdr'],
			];
			$this->db->where('tb_dataanak_id', $anakid);
			$this->db->update('tb_dataanak', $dataisi);
			foreach ($input as $k => $input3) {
				if ($input3 == null) {
					$this->session->set_flashdata('message1', 'error');
					$this->session->set_flashdata('message2', 'Data tidak boleh kosong');
					redirect('welcome/uploadformobservasi/' . $tb_dataanak_id);
				} else {
					$ceksoal = $this->db->get_where('tb_observasi_ot_super', ['tb_observasi_ot_super_name' => $k])->row_array();
					if ($ceksoal) {
						if (!$ceksoal['tb_observasi_ot_super_name2']) {
							$jawaban = [
								'tb_observasi_ot_super_id' => $ceksoal['tb_observasi_ot_super_id'],
								'tb_observasi_ot_jawaban_text' => $input3,
								'tb_dataanak_id' => $anakid,
								'date_created' => date('Y/m/d'),
							];
							$this->db->insert('tb_observasi_ot_jawaban', $jawaban);
						} else {
							foreach ($input as $j => $input2) {
								if ($j == $ceksoal['tb_observasi_ot_super_name2']) {
									$jawaban = [
										'tb_observasi_ot_super_id' => $ceksoal['tb_observasi_ot_super_id'],
										'tb_observasi_ot_jawaban_text' => 'umur ' . $input3 . ' bulan ' . $input2 . ' tahun',
										'tb_dataanak_id' => $anakid,
										'date_created' => date('Y/m/d'),
									];
									$this->db->insert('tb_observasi_ot_jawaban', $jawaban);
								}
							}
						}
					}
				}
			}
			$this->session->set_flashdata('message1', 'success');
			$this->session->set_flashdata('message2', 'Jawaban Sukses Disimpan');
			redirect('welcome/tahuncalonsiswa/' . $this->encryptor->enkrip('enkrip', $data['dataanak']['tb_dataanak_tahun']));
		}
	}

	public function cetakobservasi($tb_dataanak_id)
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
