<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPDB | PAUD dan SD Bintang Juara</title>

  <!-- styles link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <link href="<?= base_url('assets/landingpage/') ?>vendor/fontawesome-free-6.2.0-web/css/fontawesome.css" rel="stylesheet" />
  <link href="<?= base_url('assets/landingpage/') ?>vendor/fontawesome-free-6.2.0-web/css/brands.css" rel="stylesheet" />
  <link href="<?= base_url('assets/landingpage/') ?>vendor/fontawesome-free-6.2.0-web/css/solid.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('assets/landingpage/') ?>css/homepage.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- favicon -->
  <link rel="shortcut icon" href="<?= base_url('assets/landingpage/') ?>public/favicon.ico" type="image/x-icon" />
</head>

<body>
  <div class="flash-data" data-flashdata1="<?= $this->session->flashdata('message1'); ?>" data-flashdata2="<?= $this->session->flashdata('message2'); ?>"></div>

  <!-- start contact -->
  <div class="header d-none d-md-block">
    <div class="container-fluid p-3">
      <div class="d-flex justify-content-center align-items-center">
        <div class="d-flex align-items-center gap-2 border-end pe-3">
          <i class="fa-regular fa-map"></i>
          <p class="fs-7">
            Jl. Dewi Sartika, Sukorejo, Gunung Pati, Semarang, Jawa Tengah
            50221
          </p>
        </div>
        <div class="d-none d-xl-flex align-items-center gap-2 border-end px-3">
          <i class="fa-regular fa-envelope"></i>
          <a class="text-white fs-7" href="mailto:sdislambintangjuara@gmail.com">sdislambintangjuara@gmail.com</a>
        </div>
        <div class="d-flex align-items-center gap-2 px-3">
          <i class="fa-regular fa-phone"></i>
          <a class="text-white fs-7" href="tel:+62823-1493-0833">+62823-1493-0833</a>
        </div>
      </div>
    </div>
  </div>
  <!-- end contact -->

  <!-- start navbar -->
  <nav class="navbar navbar-expand-lg bg-light py-2 px-3 px-sm-2 sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url(); ?>">
        <span class="navbar-brand_caption">Bintang Juara</span>
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav align-items-center">
          <?php if ($title == 'Beranda') : ?>
            <a class="nav-link active" href="<?= base_url(); ?>">Beranda</a>
          <?php else : ?>
            <a class="nav-link" href="<?= base_url(); ?>">Beranda</a>
          <?php endif ?>
          <?php if ($title == 'Galeri') : ?>
            <a class="nav-link active" href="<?= base_url(); ?>">Galeri</a>
          <?php else : ?>
            <a class="nav-link" href="<?= base_url(); ?>">Galeri</a>
          <?php endif ?>
          <?php if ($title == 'Berita') : ?>
            <a class="nav-link active" href="<?= base_url(); ?>">Berita</a>
          <?php else : ?>
            <a class="nav-link" href="<?= base_url(); ?>">Berita</a>
          <?php endif ?>
          <?php if ($this->usr->getUserlog()) : ?>
            <?php $user = $this->usr->getUserlog(); ?>
            <li>
              <?php if ($title == 'Data Siswa') : ?>
                <a href="<?= base_url('welcome/datacalonsiswa'); ?>" class="nav-link active">Data Calon Siswa (Bp. <?= $user['user_profile']; ?>)</a>
              <?php else : ?>
                <a href="<?= base_url('welcome/datacalonsiswa'); ?>" class="nav-link ">Data Calon Siswa (Bp. <?= $user['user_profile']; ?>)</a>
              <?php endif ?>
            </li>
            <div class="separator"></div>
            <!-- <a
            class="nav-link"
            href="/index.html"
            >Daftar</a
            > -->
            <div>
              <a class="btn btn-danger button-rounded transition-all-200 fs-7 ms-2" style="color: white;" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
          <?php else : ?>
            <li>
              <?php if ($title == 'Pendaftaran') : ?>
                <a href="<?= base_url('welcome/pendaftaran'); ?>" class="nav-link active">Pendaftaran</a>
              <?php else : ?>
                <a href="<?= base_url('welcome/pendaftaran'); ?>" class="nav-link">Pendaftaran</a>
              <?php endif ?>
            </li>
            <div class="separator"></div>
            <!-- <a
            class="nav-link"
            href="/index.html"
            >Daftar</a
            > -->
            <div>
              <a class="btn btn-warning button-rounded transition-all-200 fs-7 ms-2" href="<?= base_url('auth') ?>">Login</a>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div role="button" class="navbar-toggler_button">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
  </nav>
  <?= $this->session->flashdata('message'); ?>

  <!-- end navbar -->