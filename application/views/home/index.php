<!-- start header -->
<header class="jumbotron position-relative">
  <?php if ($this->usr->getUserlog()) : ?>
    <div class="container">
      <div class="row" style="margin-top: 50px;">
        <div class="col">
          <div class="card">
            <img class="card-img-top" src="<?= base_url('assets/images/landingpage/1.png'); ?>" alt="Card image cap">
            <hr>
            <div class="card-body">
              <h5 class="card-title" style="text-align: center;">Profile KB / TK Bintang Juara</h5>
              <a href="<?= base_url('assets/files/PUBLISH_PROFIL KB-TK ISLAM BINTANG JUARA_TP 2021_2022.pdf'); ?>" class="btn btn-info" target="_blank" style="width: 100%; color: white;">Download PDF Profile</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img class="card-img-top" src="<?= base_url('assets/images/landingpage/2.png'); ?>" alt="Card image cap">
            <hr>
            <div class="card-body">
              <h5 class="card-title" style="text-align: center;">Profile Baby House Bintang Juara</h5>
              <a href="<?= base_url('assets/files/PROFIL BABY HOUSE ISLAM BINTANG JUARA_2021.pdf'); ?>" class="btn btn-info" target="_blank" style="width: 100%; color: white;">Download PDF Profile</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img class="card-img-top" src="<?= base_url('assets/images/landingpage/3.png'); ?>" alt="Card image cap">
            <hr>
            <div class="card-body">
              <h5 class="card-title" style="text-align: center;">Profile SD Islam Bintang Juara</h5>
              <a href="<?= base_url('assets/files/PUBLISH_PPDB TP 2022_PROFIL SD ISLAM BINTANG JUARA.pdf'); ?>" class="btn btn-info" target="_blank" style="width: 100%; color: white;">Download PDF Profile</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 50px;">
        <div class="container">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8">
                  <h5 class="card-title" style="text-align: right;">Info Lebih Lanjut hubungi :</h5>
                </div>
                <div class="col-sm-4">
                  <a href="https://wa.me/6289616767100" class="btn btn-danger" target="_blank" style="width: 100%; color: white;">(Admin PPDB - 0896-1676-7100)</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= base_url('assets/images/landingpage/Pembiasaan-Ibadah-1.png'); ?>" class="carousel-item_image" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('assets/images/landingpage/Psikolog.png'); ?>" class="carousel-item_image" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('assets/images/landingpage/Kreatif-1.png'); ?>" class="carousel-item_image" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('assets/images/landingpage/Mandiri-Tanggungjawab.png'); ?>" class="carousel-item_image" alt="..." />
        </div>
        <div class="carousel-item">
          <img src="<?= base_url('assets/images/landingpage/Wakaf-Pendidikan.png'); ?>" class="carousel-item_image" alt="..." />
        </div>
      </div>
    </div>
    <div class="carousel_slide">
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  <?php endif; ?>
</header>
<!-- end header -->

<!-- Start CONTENT -->
<main>
  <section class="my-5">
    <div class="container containers">
      <h2 class="fw-bold text-center mb-4">Informasi PPDB</h2>
      <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3 gap-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
            Pengumuman
          </button>
          <button class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            Profile
          </button>
          <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
            Berita
          </button>
          <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
            Galery
          </button>
          <button class="nav-link" id="v-pills-kegiatan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kegiatan" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
            Jadwal kegiatan
          </button>
        </div>
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade tab_panel shadow" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
            <ul class="nav nav-pills mb-3 gap-2" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  PAUD
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                  SD
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                PAUD ISLAM BINTANG JUARA Juara merupakan Lembaga PAUD terpadu dengan layanan pengasuhan anak (daycare). PAUD Islam Bintang Juara memiliki prinsip Pendidikan Holistik Integratif yang mengutamakan peletakan pondasi Akidah, pembiasaan Akhlakul Karimah dan Adab Islami. Sejak awal berdiri, PAUD Islam Bintang Juara memiliki upaya optimalisasi perkembangan seluruh aspek perkembangan dan potensi Multiple Intelligences anak usia dini.
                PAUD Islam Bintang Juara Diresmikan pada hari Kamis, 16 Mei 2013 di Jl. Dewi Sartika No. 82 Semarang di bawah naungan Yayasan Dewi Sartika Semarang.
                PAUD Islam Bintang Juara didirikan oleh Ibu Dyah Indah Noviyani, S.Psi., M.Psi selaku Ketua Yayasan didukung penuh oleh Dewan Pembina : Ibu Dr. Hj. Esmi Warassih, SH, MS. Dan
                Bapak Drs. H. Abdullah Sodiq.

              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                SD ISLAM BINTANG JUARA adalah Islamic Character Based school yang mengedepankan pendidikan diniyyah seperti pembiasaan ibadah, tahsin & tahfidz, serta penanaman adab dan akhlak mulia. Kami juga menerapkan pembelajaran holistik integratif dengan mengintegrasikan segala aspek dan nilai-nilai dalam pendidikan seperti nilai moral, etis, religius, psikologis, dan sosial dalam kesatuan yang dilakukan secara menyeluruh antara jiwa dan badan serta aspek material dan aspek spiritual untuk memenuhi kebutuhan esensial anak.
                <br>
                Visi
                “Unggul dalam Optimalisasi Aspek Perkembangan dan Potensi Kecerdasan Majemuk (Multiple Intelligences) serta Akhlak Mulia Anak Usia Dini berbasis Nilai-nilai Islami”

              </div>
            </div>
          </div>
          <div class="tab-pane fade tab_panel shadow show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
            <p>
              Penerimaan Peserta Didik Baru (PPDB) Gelombang 2 (Januari- Maret 2023)
              <br>
              SD Islam Bintang Juara Semarang
              <br>
              Sekolah Calon Pemimpin Muslim
              <br>
              Tahun Pelajaran 2023-2024
              <hr>
              NPSN : 69994958
              <br>
              No. SK Ijin Pendirian : 421.2/10684/2019
              <br>
              Satu-satunya SD yang terpilih sebagai Sekolah Penggerak - Angkatan ke-2 di Kecamatan Gunung Pati
              <br>
              SK sebagai Sekolah Penggerak : 0301/C/HK.00/2022
              <br>
              <br>
              ⭐⭐⭐⭐⭐⭐⭐⭐⭐
              <br>
              <br>
              SD Islam Bintang Juara Semarang merupakan fullday school dengan konsep fun & meaningfull daily activites :
              <br>
            </p>
            <table class="table table-striped mt-5">
              <tbody>
                <tr>
                  <th scope="row">💫</th>
                  <td>Prioritas kami Penguatan pondasi akidah ketauhidan, akhlakul karimah, adab Islami, tarbiyah ibadah, jiwa kepemimpinan dengan memperhatikan seluruh aspek perkembangan dan potensi unggul (fitrah) peserta didik yang beragam. </td>
                </tr>
                <tr>
                  <th scope="row">💫</th>
                  <td>Komitmen kami Memberikan pijakan yang tepat dan pendampingan secara penuh sebagai upaya menyiapkan anak memasuki masa baligh dan menjadi pribadi yang tamyiz (matang secara psikis dan akal, dapat membedakan yang haq dan bathil, menjadi pribadi yang bermanfaat). </td>
                </tr>
                <tr>
                  <th scope="row">💫</th>
                  <td>Penerapan Kurikulum Merdeka Setiap guru memahami profil kebutuhan dan perkembangan setiap peserta didik, menggunakan metode pembelajaran teaching at the right level (pembelajaran yang sesuai dengan capaian perkembangan peserta didik) serta Proyek Penguatan Profil Pelajar Pancasila (P5).</td>
                </tr>
                <tr>
                  <th scope="row">💫</th>
                  <td>Program sekolah yang bervariasi dan bermutu / bermakna untuk menguatkan semua pondasi pribadi peserta didik dan mengoptimalkan seluruh aspek perkembangan peserta didik, termasuk kegiatan makan siang dan snack sore yang sehat dan bergizi dari sekolah, kegiatan tidur siang untuk memulihkan energi dan melatih adab tidur, program unggulan Olimpiade Sains dan Matematika serta Tahfidz dan Tadabbur Qur'an dengan Metode Kauny serta ekstrakurikuler wajib (Pramuka).</td>
                </tr>
              </tbody>
            </table>
            <p style="text-align: center;">
              <b>DAFTAR SEKARANG</b> dapatkan beragam pilihan manfaatnya
              <br>
              Gelombang 2 (Mulai 1 Januari hingga 31 Maret 2023)
            </p>
            <table class="table table-striped mt-5">
              <tbody>
                <tr>
                  <th scope="row">⭐</th>
                  <td>Biaya Khusus bagi Alumni TK Islam Bintang Juara.</td>
                </tr>
                <tr>
                  <th scope="row">⭐</th>
                  <td>Beasiswa Khusus bagi keluarga Dhuafa.</td>
                </tr>
                <tr>
                  <th scope="row">⭐</th>
                  <td>Beasiswa Khusus bagi Anak yang Hafal Al Qur'an minimal 1 Juz (Juz 30).</td>
                </tr>
                <tr>
                  <th scope="row">⭐</th>
                  <td>Kemudahaan Pembayaran Biaya Pendidikan secara Bertahap.</td>
                </tr>
                <tr>
                  <th scope="row">⭐</th>
                  <td>Keringanan Biaya Pendidikan (S & K berlaku)</td>
                </tr>
              </tbody>
            </table>
            <p style="text-align: center;">
              Ayah Bunda membutuhkan partner yang amanah dan siap berkolaborasi dalam mendidik putra-putri menjadi calon pemimpin Muslim yang berilmu, berakhlakul karimah dan bermanfaat?
              <br>
              Mari bergabung dan menjadi keluarga besar SD Islam Bintang Juara.
              <br>
              <br>
              👉 Klik dan Isi Form berikut : <a href="https://bit.ly/BukuTamuPPDB_SDIBJ_23-24" class="btn btn-primary">Link</a>
              <br>
              <br>
              Contact person selama hari kerja dan jam kerja (Senin - Sabtu pukul 07.30 - 15.30 WIB)
              <br>
              📞 0896-1676-7100 (Admin PPDB)
              <br>
              📞 0852-2917-8062 (Bu Ni'mah)
              <br>
              <br>
              ⭐⭐⭐⭐⭐⭐⭐⭐⭐
              <br>
              <b>Setiap Anak adalah BINTANG dan Berhak Menjadi JUARA</b>
              <br>
              ⭐⭐⭐⭐⭐⭐⭐⭐⭐
              <br>
              <br>
              Semarang Kota Layak Anak melalui Sekolah Ramah Anak
              <br>
              <br>
              #SDIslamBintangJuara
              <br>
              #SekolahCalonPemimpinMuslim
              <br>
              #BerilmuBerakhlakulKarimahBermanfaat
              <br>
              #SekolahRamahAnak
            </p>
          </div>
          <div class="tab-pane fade tab_panel shadow" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
            <ul class="nav nav-pills mb-3 gap-2" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-homee-tab" data-bs-toggle="pill" data-bs-target="#pills-homee" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  Berita 1
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profilee-tab" data-bs-toggle="pill" data-bs-target="#pills-profilee" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                  Berita 2
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-homee" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-5">
                    <img src="<?= base_url('assets/images/landingpage/Picture1.jpg'); ?>" alt="image" style="width: 100%">
                  </div>
                  <div class="col-lg-7">
                    🎊 FREE TRIAL CLASS 🎊
                    <br>
                    PAUD ISLAM BINTANG JUARA
                    <br>
                    <br>
                    Kabar gembira untuk kita semua. PAUD Islam Bintang Juara akan membuka kesempatan pada calon siswa baru untuk melakukan kegiatan free trial class di sekolah kami 😊😊
                    <br>
                    <br>
                    Ananda mendapat kesempatan untuk berkegiatan pada salah satu Sentra di sekolah kami, yaitu Sentra Bahan Alam. Sembari Ananda berkegiatan, Ayah Bunda dapat melakukan diskusi perkembangan anak dengan Bunda Vivi Psikolog.
                    <br>
                    <br>
                    Segera daftarkan Ayah, Bunda, dan Ananda melalui link berikut:
                    <br>
                    <a href="https://bit.ly/FreeTrialPAUDIBJ2023">https://bit.ly/FreeTrialPAUDIBJ2023</a>
                    <br>
                    🎈 KUOTA TERBATAS UNTUK 15 PESERTA
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-profilee" role="tabpane2" aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-5">
                    <img src="<?= base_url('assets/images/landingpage/Picture2.jpg'); ?>" alt="image" style="width: 100%">
                  </div>
                  <div class="col-lg-7">
                    <b>SCHOOL TOURING</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade tab_panel shadow" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
            No Display
          </div>
          <div class="tab-pane fade tab_panel shadow" id="v-pills-kegiatan" role="tabpanel" aria-labelledby="v-pills-kegiatan-tab" tabindex="0">
            <ul class="nav nav-pills mb-3 gap-2" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-satu-tab" data-bs-toggle="pill" data-bs-target="#pills-satu" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  JADWAL KEGIATAN BABY HOUSE
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-dua-tab" data-bs-toggle="pill" data-bs-target="#pills-dua" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  TK
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-tiga-tab" data-bs-toggle="pill" data-bs-target="#pills-tiga" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  KB
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-empat-tab" data-bs-toggle="pill" data-bs-target="#pills-empat" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                  SD
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-satu" urole="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                  <p style="text-align: center;">Jadwal kegiatan satu hari baby class</p>
                  <img src="<?= base_url('assets/images/landingpage/Picture3.png'); ?>" alt="image" style="width: 100%">
                  <p style="text-align: center; margin-top: 15px;">Jadwal kegiatan satu hari young todler</p>
                  <img src="<?= base_url('assets/images/landingpage/Picture4.png'); ?>" alt="image" style="width: 100%">
                  <p style="text-align: center; margin-top: 15px;">Jadwal satu hari old todler</p>
                  <img src="<?= base_url('assets/images/landingpage/Picture5.png'); ?>" alt="image" style="width: 100%">
                </div>
              </div>
              <div class="tab-pane fade show" id="pills-dua" role="tabpane2" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                  <p style="width: 100%;"></p>
                  <img src="<?= base_url('assets/images/landingpage/Picture6.png'); ?>" alt="image" style="width: 100%">
                </div>
              </div>
              <div class="tab-pane fade" id="pills-tiga" role="tabpane3" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                  <p style="width: 100%;"></p>
                  <img src="<?= base_url('assets/images/landingpage/Picture9.png'); ?>" alt="image" style="width: 100%">
                </div>
              </div>
              <div class="tab-pane fade" id="pills-empat" role="tabpane4" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                  <p style="width: 100%;"></p>
                  <img src="<?= base_url('assets/images/landingpage/Picture8.png'); ?>" alt="image" style="width: 100%">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- End CONTENT -->

<!-- Start FOOTER -->