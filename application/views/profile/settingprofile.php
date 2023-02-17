<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-7">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Ganti Password Aplikasi</h4>
          <h6 class="card-subtitle">Form Pergantian Password Baru</h6>
          <hr>
          <form action="<?= base_url('profile/ubahpassword'); ?>" method="post">
            <div class="form-body">
              <div class="form-group">
                <div class="row">
                  <label class="col-md-3 text-left">Password Lama </label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="passowrd" id="passowrd" placeholder="Tuliskan Password Lama Anda disini">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-md-3 text-left">Password Baru </label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="passowrd1" id="passowrd1" placeholder="Tuliskan Password Baru Anda Di Sini">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-md-3 text-left">Ulangi Pasword Baru </label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="passowrd2" id="passowrd2" placeholder="Tuliskan Kembali Password Baru Anda Di Sini">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-actions">
              <div class="text-right">
                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Ubah Password</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-5">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Ubah Profile Picture</h4>
          <h6 class="card-subtitle">Ubah Profile Picture Akun kamu disini</h6>
          <hr>
          <?= form_open_multipart('profile/ubahfoto'); ?>
          <div class="form-body">
            <div class="row">
              <div class="col-5">
                <?php if ($user['user_image'] == 'deafault.png') : ?>
                  <img src="<?= base_url('assets/images/user_profile/'); ?>default.png" alt="profpic" style="width: 100%;">
                <?php else : ?>
                  <img src="<?= base_url('assets/images/user_profile/') . $user['user_image']; ?>" alt="profpic" style="width: 100%;">
                <?php endif ?>
              </div>
              <div class="col-7">
                <div class="form-group">
                  <label class="text-left">Profile Picture </label>
                  <input type="file" class="form-control" name="file" id="file">
                </div>
              </div>
            </div>
          </div>
          <div class="form-actions">
            <div class="text-right">
              <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Ubah Profile Picture</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->