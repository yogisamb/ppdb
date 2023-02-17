<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-7">
              <h4 class="card-title"><?= $submenu ?></h4>
            </div>
            <div class="col-5"><a href="#" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#bs-example-modal-lg"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Role User</a></div>
          </div>
          <hr>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Hak Akses</th>
                  <th style="text-align: right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($hakakses as $ha) : ?>
                  <tr>
                    <form action="<?= base_url('manajemen/ubahrole'); ?>" method="POST">
                      <td class="text-left"><?= $nomor; ?></td>
                      <td>
                        <input type="hidden" name="roleid" id="roleid" value="<?= $this->encryptor->enkrip('enkrip', $ha['user_role_id']); ?>">
                        <input type="text" name="title" id="title" class="form-control" value="<?= $ha['user_role_title']; ?>">
                      </td>
                      <td class="td-actions text-right">
                        <button type="submit" rel="tooltip" class="btn btn-warning">
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="<?= base_url('manajemen/index/') . $this->encryptor->enkrip('enkrip', $ha['user_role_id']); ?>" rel="tooltip" class="btn btn-info">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                    </form>
                  </tr>
                  <?php $nomor++ ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Data Hak Akses
            <?php
            if ($roleuser != null) {
              echo $roleuser['user_role_title'];
            }
            ?>
          </h4>
          <hr>
          <div class="table-responsive">
            <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
              <thead>
                <tr>
                  <th>Hak Akses</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($hakaksesuser != null) : ?>
                  <?php $nomor = 1; ?>
                  <?php foreach ($hakaksesuser as $hu) : ?>
                    <tr>
                      <td>
                        <div class="row" style="margin: 0;">
                          <input class="border-checkbox" type="checkbox" id="checkbox2" <?= check_access($roleuser['user_role_id'], $hu['user_menu_id']); ?> data-role="<?= $roleuser['user_role_id']; ?>" data-roleenkrip="<?= $this->encryptor->enkrip('enkrip', $roleuser['user_role_id']); ?>" data-menu="<?= $hu['user_menu_id']; ?>">
                          &nbsp;&nbsp;&nbsp;<?= $hu['user_menu_title']; ?>
                        </div>
                      </td>
                    </tr>
                    <?php $nomor++ ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td style="color: red; text-align: center;">Belum Memilih Hak Akses User</td>
                  </tr>
                <?php endif; ?>
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
        <h4 class="modal-title" id="myLargeModalLabel">Tambah User Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <form action="<?= base_url('manajemen/tambahrole'); ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <label class="col-md-3 text-left">Nama User Role </label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="title" id="title" placeholder="Tuliskan Nama User Role Baru Di Sini">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Simpan Role User</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->