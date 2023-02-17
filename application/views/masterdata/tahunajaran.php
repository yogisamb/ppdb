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
            <div class="col-3"><a href="#" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#bs-example-modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Masa PPDB</a></div>
          </div>
          <hr>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tahun Ajaran</th>
                  <th>Tanggal Awal PPDB</th>
                  <th>Penutupan PPDB</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($tahunajaran as $ta) : ?>
                  <tr>
                    <td><?= $i; ?>.</td>
                    <td><?= $ta['tb_tahun_title']; ?></td>
                    <td><?= date('D, d M Y', strtotime($ta['tb_tahun_awal'])); ?></td>
                    <td><?= date('D, d M Y', strtotime($ta['tb_tahun_akhir'])); ?></td>
                    <td>
                      <?php if ($ta['is_active'] == 0) : ?>
                        <a href="<?= base_url('masterdata/isaktiftahunajaran/') . $this->encryptor->enkrip('enkrip', $ta['tb_tahun_id']); ?>" class="badge badge-danger">Non Aktif</a>
                      <?php else : ?>
                        <a href="<?= base_url('masterdata/isaktiftahunajaran/') . $this->encryptor->enkrip('enkrip', $ta['tb_tahun_id']); ?>" class="badge badge-success">Aktif</a>
                      <?php endif ?>
                    </td>
                    <td>
                      <a href="<?= base_url('masterdata/edittahunajaran/') . $this->encryptor->enkrip('enkrip', $ta['tb_tahun_id']); ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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
        <h4 class="modal-title" id="myLargeModalLabel">Tambah MAsa PPDB Tahun Ajaran Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="<?= base_url('masterdata/tahunajaran'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Title Tahun Ajaran</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="title" name="title" placeholder="Title Tahun Ajaran">
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Mulai Masa PPDB</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="awal" name="awal" placeholder="Mulai Masa PPDB">
            </div>
          </div>
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Akhir Masa PPDB</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="akhir" name="akhir" placeholder="Akhir Masa PPDB">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Simpan Tahun Ajaran</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->