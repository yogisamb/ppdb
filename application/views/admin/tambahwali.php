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
          <h4 class="card-title"><?= $supersubmenu; ?></h4>
          <hr>
          <form action="<?= base_url('admin/tambahwali/'); ?>" method="POST">
            <div class="row form-group">
              <div class="col-md-12  mb-3">
                <label class="form-label form_label" for="email">Data Ayah</label>
                <div class="row">
                  <div class="col-md-6"><input type="text" id="namaayah" name="namaayah" class="form-control" placeholder="Nama Ayah" value="<?= set_value('namaayah'); ?>"> <?= form_error('namaayah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                  <div class="col-md-6"><input type="text" id="telpayah" name="telpayah" class="form-control" placeholder="Nomor Telp Ayah" value="<?= set_value('namaibu'); ?>"> <?= form_error('telpayah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12  mb-3">
                <div class="row">
                  <div class="col-md-6"><input type="text" id="pekerjaanayah" name="pekerjaanayah" class="form-control" placeholder="Pekerjaan Ayah" value="<?= set_value('pekerjaanayah'); ?>"> <?= form_error('pekerjaanayah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                  <div class="col-md-6"><input type="text" id="umurayah" name="umurayah" class="form-control" placeholder="Tahun Lahir" value="<?= set_value('umurayah'); ?>"> <?= form_error('umurayah', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12  mb-3">
                <label class="form-label form_label" for="email">Data ibu</label>
                <div class="row">
                  <div class="col-md-6"><input type="text" id="namaibu" name="namaibu" class="form-control" placeholder="Nama ibu" value="<?= set_value('namaibu'); ?>"> <?= form_error('namaibu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                  <div class="col-md-6"><input type="text" id="telpibu" name="telpibu" class="form-control" placeholder="Nomor Telp ibu" value="<?= set_value('telpibu'); ?>"> <?= form_error('telpibu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12  mb-3">
                <div class="row">
                  <div class="col-md-6"><input type="text" id="pekerjaanibu" name="pekerjaanibu" class="form-control" placeholder="Pekerjaan ibu" value="<?= set_value('pekerjaanibu'); ?>"> <?= form_error('pekerjaanibu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                  <div class="col-md-6"><input type="text" id="umuribu" name="umuribu" class="form-control" placeholder="Tahun Lahir Ibu" value="<?= set_value('umuribu'); ?>"> <?= form_error('umuribu', '<small class="text-danger pl-3">', '</small>'); ?></div>
                </div>
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12  mb-3">
                <label class="form-label form_label" for="email">Data Untuk Login</label>
                <div class="row">
                  <div class="col-md-6">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Bapak / Ibu" value="<?= set_value('email'); ?>">
                    <div id="hasilemail" class="form-text">
                      <p style="color: gray; font-size: 10px;">Email Tidak Boleh Kosong</p>
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <input type="text" id="password" name="password" class="form-control" placeholder="Password untuk aplikasi" value="<?= set_value('password'); ?>">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                    <a href="#" class="btn btn-info" id="randompassword" style="width: 100%;"> <i class="fas fa-random"></i>&nbsp;&nbsp;&nbsp;Random Pass</a>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-success" type="submit" style="margin-top: 20;"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan User</button>
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