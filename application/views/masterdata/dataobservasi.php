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
            <div class="col-3"><a href="#" class="btn btn-success" style="width: 100%;" data-toggle="modal" data-target="#bs-example-modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Data Observasi</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $nomor = 1 ?>
  <?php foreach ($dataobservasi as $do) : ?>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h4 class="card-title">Observasi - <?= $do['tb_observasi_title']; ?></h4>
              </div>
              <div class="col-2"><a href="#" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#tambahsubobservasi<?= $nomor; ?>"><i class=" fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Sub Observasi</a></div>
              <div class="col-1"><a href="#" class="btn btn-warning" style="width: 100%;" data-toggle="modal" data-target="#editsubobservasi<?= $nomor; ?>"><i class="fas fa-edit"></i></a></div>
              <?php if ($do['is_active'] == 1) : ?>
                <div class="col-1"><a href="<?= base_url('masterdata/isactiveobservasi/') . $this->encryptor->enkrip('enkrip', $do['tb_observasi_id']); ?>" class="btn btn-danger" style="width: 100%;"><i class="fas fa-trash"></i></a></div>
              <?php else : ?>
                <div class="col-1"><a href="<?= base_url('masterdata/isactiveobservasi/') . $this->encryptor->enkrip('enkrip', $do['tb_observasi_id']); ?>" class="btn btn-light" style="width: 100%;"><i class="fas fa-trash"></i></a></div>
              <?php endif; ?>
            </div>
            <div class="modal fade" id="tambahsubobservasi<?= $nomor; ?>" tabindex="-1" aria-labelledby="tambahsubobservasi<?= $nomor; ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Observasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?= base_url('masterdata/tambahobservasisub/') . $this->encryptor->enkrip('enkrip', $do['tb_observasi_id']); ?>" method="post">
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-3 col-form-label">Title Sub Observasi</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="nama" name="nama" placeholder="Title Sub Observasi">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan Sub Observasi</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal fade" id="editsubobservasi<?= $nomor; ?>" tabindex="-1" aria-labelledby="editsubobservasi<?= $nomor; ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Observasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?= base_url('masterdata/editobservasi/') . $this->encryptor->enkrip('enkrip', $do['tb_observasi_id']); ?>" method="post">
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-3 col-form-label">Title observasi</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="nama" name="nama" value="<?= $do['tb_observasi_title']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;Edit Observasi</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <hr>
            <?php
            $subobservasi[$nomor] = $this->bj->getSubobservasibyobservasiid($do['tb_observasi_id']);
            $nomordetail[$nomor] = 1;
            $detailnomor = 1;
            ?>
            <div class="table-responsive">
              <table id="example<?= $nomor; ?>" class="table table-striped table-bordered no-wrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Sub Observasi Detail</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($subobservasi[$nomor] as $so[$nomor]) : ?>
                    <tr>
                      <td><?= $nomordetail[$nomor]; ?>.</td>
                      <td><?= $so[$nomor]['tb_observasi_sub_title']; ?></td>
                      <td>
                        <?php if ($so[$nomor]['is_active'] == 1) : ?>
                          <a href="<?= base_url('masterdata/isactiveso/') . $this->encryptor->enkrip('enkrip', $so[$nomor]['tb_observasi_sub_id']); ?>" class="badge badge-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Aktif</a>
                        <?php else : ?>
                          <a href="<?= base_url('masterdata/isactiveso/') . $this->encryptor->enkrip('enkrip', $so[$nomor]['tb_observasi_sub_id']); ?>" class="badge badge-danger"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Tidak Aktif</a>
                        <?php endif ?>
                      </td>
                      <td style="text-align: right;">
                        <a href="<?= base_url('masterdata/supersubobservasi/') . $this->encryptor->enkrip('enkrip', $so[$nomor]['tb_observasi_sub_id']); ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editobservasisub<?= $nomor; ?><?= $detailnomor; ?>"><i class="fas fa-edit"></i></a>
                        <div class="modal fade" id="editobservasisub<?= $nomor; ?><?= $detailnomor; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Observasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form action="<?= base_url('masterdata/editsubobservasi/') . $this->encryptor->enkrip('enkrip', $so[$nomor]['tb_observasi_sub_id']); ?>" method="post">
                                <div class="modal-body">
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Title Sub Observasi</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $so[$nomor]['tb_observasi_sub_title']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;Edit Sub Observasi</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php
                    $nomordetail[$nomor]++;
                    $detailnomor++;
                    ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php $nomor++; ?>
  <?php endforeach ?>
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
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Data Observasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="<?= base_url('masterdata/observasi'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group row">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Title Perkembangan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Title Perkembangan">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan Data Observasi</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->