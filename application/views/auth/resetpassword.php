<!--
=========================================================
* System Develop By Yogisamb - v1.0.1
=========================================================

* Copyright 2022 Solo Bersimfoni (Sekolah Adipangastuti)
* Licensed under MIT

* Coded by "GAGE Design" (https://www.gagedesign.id)

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $fvcn = $this->bj->getFavicon();
  $ttl = $this->bj->getJudul();
  $jbtrn = $this->bj->getJumbotron();
  ?>
  <title><?= $ttl['tb_config_isi']; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/') . $fvcn['tb_config_isi']; ?>" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="<?= base_url('assets/auth/'); ?>text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>css/util.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/auth/'); ?>css/main.css">
  <!--===============================================================================================-->
</head>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(<?= base_url('assets/images/') . $jbtrn['tb_config_isi']; ?>);">
          <span class="login100-form-title-1">
            Forgot Password
          </span>
        </div>

        <form class="login100-form validate-form" method="POST" action="<?= base_url('auth/changepassword'); ?>">
          <?= $this->session->flashdata('message'); ?>
          <div class="wrap-input100 validate-input m-b-26" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password1" id="password1" placeholder="Enter Password">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-26" data-validate="Password is required">
            <span class="label-input100">Ulangi Password</span>
            <input class="input100" type="password" name="password2" id="password2" placeholder="Enter Password">
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
              Ubah Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>vendor/bootstrap/js/popper.js"></script>
  <script src="<?= base_url('assets/auth/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>vendor/daterangepicker/moment.min.js"></script>
  <script src="<?= base_url('assets/auth/'); ?>vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="<?= base_url('assets/auth/'); ?>js/main.js"></script>

</body>

</html>