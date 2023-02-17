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
          <h4 class="card-title"><?= $submenu ?></h4>
          <hr>
          <?php
          $user_provinsi = $this->usr->getUserdataprovinsiuser($datasekolah['tb_provinsi_id']);
          $user_kabupaten = $this->usr->getUserdatakabupatenkotauser($datasekolah['tb_kabupaten_kota_id']);
          $user_kecamatan = $this->usr->getUserdatakecamatanuser($datasekolah['tb_kecamatan_id']);
          $user_kelurahan = $this->usr->getUserdatakelurahanuser($datasekolah['tb_kelurahan_id']);
          ?>
          <form action="<?= base_url('masterdata/editsekolah/' . $this->encryptor->enkrip('enkrip', $datasekolah['tb_sekolah_id'])); ?>" method="POST">
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Nama Sekolah</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $datasekolah['tb_sekolah_title']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Alamat Sekolah</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $datasekolah['tb_sekolah_alamat']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Provinsi</label>
              <div class="col-sm-9">
                <select class="form-control" name="provinsi" id="provinsi">
                  <option value="<?= $user_provinsi['id_provinsi']; ?>"><?= $user_provinsi['name']; ?></option>
                  <?php foreach ($provinsi as $p) : ?>
                    <option value="<?= $p['id_provinsi']; ?>"><?= $p['name']; ?></option>
                  <?php endforeach; ?>
                </select>
                <?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Kabupaten / Kota</label>
              <div class="col-sm-9">
                <select id="kotakabupaten" name="kotakabupaten" class="form-control">
                  <option value="<?= $user_kabupaten['id_kabupaten_kota']; ?>"><?= $user_kabupaten['name']; ?></option>
                </select>
                <?= form_error('kotakabupaten', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Kecamatan</label>
              <div class="col-sm-9">
                <select name="kecamatan" id="kecamatan" class="form-control">
                  <option value="<?= $user_kecamatan['id_kecamatan']; ?>"><?= $user_kecamatan['name']; ?></option>
                </select>
                <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Kecamatan</label>
              <div class="col-sm-9">
                <select name="kelurahan" id="kelurahan" class="form-control">
                  <option value="<?= $user_kelurahan['id_kelurahan']; ?>"><?= $user_kelurahan['name']; ?></option>
                </select>
                <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label">Telp</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="telp" name="telp" value="<?= $datasekolah['tb_sekolah_telp']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-3 col-form-label"></label>
              <div class="col-sm-9">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan Data Sekolah</button>
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