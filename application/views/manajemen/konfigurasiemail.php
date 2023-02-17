<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Konfigurasi Email</h4>
          <h6 class="card-subtitle">Konfigurasikan Email untuk otomatisasi pengiriman Notifikasi ke akun yang terdaftar di dalam sistem</h6>
          <hr>
          <form action="<?= base_url('manajemen/konfigurasiemail'); ?>" method="post">
            <div class="form-body">
              <?php if ($config) : ?>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-3 text-left">Alamat Email </label>
                    <div class="col-md-9">
                      <input type="email" class="form-control" name="email" id="email" value="<?= $config['tb_config_email_text']; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-3 text-left">Password Email </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="password" id="password" value="<?= $this->encryptor->enkrip('dekrip', $config['tb_config_email_password']); ?>">
                    </div>
                  </div>
                </div>
              <?php else : ?>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-3 text-left">Alamat Email </label>
                    <div class="col-md-9">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Tuliskan Alamat Email Di Sini">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="col-md-3 text-left">Password Email </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="password" id="password" placeholder="Tuliskan Password Generate Email Di Sini">
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
            <div class="form-actions">
              <div class="text-right">
                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Submit</button>
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