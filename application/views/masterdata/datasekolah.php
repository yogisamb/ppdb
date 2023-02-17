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
          <div class="row">
            <div class="col-9">
              <h4 class="card-title"><?= $submenu ?></h4>
            </div>
            <div class="col-3"><a href="#" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#bs-example-modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Data Sekolah</a></div>
          </div>
          <hr>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Sekolah</th>
                  <th>Alamat Sekolah</th>
                  <th>Telp Sekolah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($datasekolah as $dm) : ?>
                  <?php
                  $user_provinsi[$i] = $this->usr->getUserdataprovinsiuser($dm['tb_provinsi_id']);
                  $user_kabupaten[$i] = $this->usr->getUserdatakabupatenkotauser($dm['tb_kabupaten_kota_id']);
                  $user_kecamatan[$i] = $this->usr->getUserdatakecamatanuser($dm['tb_kecamatan_id']);
                  $user_kelurahan[$i] = $this->usr->getUserdatakelurahanuser($dm['tb_kelurahan_id']);
                  ?>
                  <tr>
                    <td><?= $i; ?>.</td>
                    <td><?= $dm['tb_sekolah_title']; ?></td>
                    <?php if ($dm['tb_sekolah_alamat']) : ?>
                      <td><?= $dm['tb_sekolah_alamat'] . ', ' . $user_kelurahan[$i]['name'] . ',<br>' . $user_kecamatan[$i]['name'] . ', ' . $user_kabupaten[$i]['name'] . ', ' . $user_provinsi[$i]['name']; ?></td>
                      <td><?= $dm['tb_sekolah_telp']; ?></td>
                    <?php else : ?>
                      <td style="color: red;">Data Baru (Mohon di Cek)</td>
                      <td style="color: red;">Data Baru (Mohon di Cek)</td>
                    <?php endif; ?>
                    <td>
                      <a href="<?= base_url('masterdata/editsekolah/') . $this->encryptor->enkrip('enkrip', $dm['tb_sekolah_id']); ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                      <a href="<?= base_url('masterdata/lihatdatasiswa/') . $this->encryptor->enkrip('enkrip', $dm['tb_sekolah_id']); ?>" class="btn btn-info"><i class="fas fa-eye"></i>&nbsp;&nbsp;&nbsp;Lihat Data Siswa</a>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
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
<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Sekolah</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="<?= base_url('masterdata'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Nama Sekolah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Sekolah">
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Alamat Sekolah</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Sekolah">
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Provinsi</label>
            <div class="col-sm-9">
              <select class="form-control" name="provinsi" id="provinsi">
                <option value=""> -- Silahkan Pilih Provinsi -- </option>
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
                <option value=""> -- Pilih Kabupaten Kota -- </option>
              </select>
              <?= form_error('kotakabupaten', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Kecamatan</label>
            <div class="col-sm-9">
              <select name="kecamatan" id="kecamatan" class="form-control">
                <option value=""> -- Pilih Kecamatan -- </option>
              </select>
              <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Kecamatan</label>
            <div class="col-sm-9">
              <select name="kelurahan" id="kelurahan" class="form-control">
                <option value=""> -- Pilih Kelurahan -- </option>
              </select>
              <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Telp</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="telp" name="telp" placeholder="Telp Sekolah">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Simpan Data Sekolah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->