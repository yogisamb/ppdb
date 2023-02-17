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
              <h4 class="card-title"><?= $submenu . ' - ' . $observasi['tb_observasi_title']; ?></h4>
            </div>
            <div class="col-3"><a href="#" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#bs-example-modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Super Sub Observasi</a></div>
          </div>
          <hr>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <th>#</th>
                <th style="width: 100px;">Sub Observasi</th>
                <th>Super Sub Observasi</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($supersubobservasi as $sso) : ?>
                  <tr>
                    <td><?= $i++; ?>.</td>
                    <td style="width: 100px; word-break: break-all;"><?= $subobservasi['tb_observasi_sub_title']; ?></td>
                    <td><?= $sso['tb_observasi_sub_super_title']; ?></td>
                    <td>
                      <?php if ($sso['is_active'] == 1) : ?>
                        <a href="<?= base_url('masterdata/isactivesso/') . $this->encryptor->enkrip('enkrip', $sso['tb_observasi_sub_super_id']); ?>" class="badge badge-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Aktif</a>
                      <?php else : ?>
                        <a href="<?= base_url('masterdata/isactivesso/') . $this->encryptor->enkrip('enkrip', $sso['tb_observasi_sub_super_id']); ?>" class="badge badge-danger"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Tidak Aktif</a>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editobservasisub<?= $i; ?>"><i class="fas fa-edit"></i></a>
                      <div class="modal fade" id="editobservasisub<?= $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Sub Observasi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="<?= base_url('masterdata/editsupersubobservasi/') . $this->encryptor->enkrip('enkrip', $sso['tb_observasi_sub_super_id']); ?>" method="post">
                              <div class="modal-body">
                                <div class="form-group row">
                                  <label for="colFormLabel" class="col-sm-3 col-form-label">Title Super Sub Observasi</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $sso['tb_observasi_sub_super_title']; ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;Edit Super Sub Observasi</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
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
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Super Sub Observasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="<?= base_url('masterdata/supersubobservasi/') . $this->encryptor->enkrip('enkrip', $subobservasi['tb_observasi_sub_id']);; ?>" method="POST">
        <div class="modal-body">
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-4 col-form-label">Title Super Sub Observasi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Title Super Sub Observasi">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan Super Sub Observasi</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->