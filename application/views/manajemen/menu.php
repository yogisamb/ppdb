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
          <h4 class="card-title"><?= $submenu ?></h4>
          <hr>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Menu</th>
                  <th style="text-align: right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($datamenu as $m) : ?>
                  <tr>
                    <form action="<?= base_url('manajemen/ubahmenu'); ?>" method="POST">
                      <td><?= $nomor; ?>.</td>
                      <td>
                        <input type="hidden" name="menuid" id="menuid" value="<?= $this->encryptor->enkrip('enkrip', $m['user_menu_id']); ?>">
                        <input type="text" name="title" id="title" class="form-control" value="<?= $m['user_menu_title']; ?>">
                      </td>
                      <td class="td-actions text-right">
                        <button type="submit" rel="tooltip" class="btn btn-warning">
                          <i class="fas fa-edit"></i>
                        </button>
                        <a href="<?= base_url('manajemen/menu/') . $this->encryptor->enkrip('enkrip', $m['user_menu_id']); ?>" rel="tooltip" class="btn btn-info">
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
          <h4 class="card-title">Data Sub Menu
          </h4>
          <div class="table-responsive">
            <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Nama Sub Menu</th>
                  <th style="text-align: right;">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($datasubmenu != null) : ?>
                  <?php $nomor = 1; ?>
                  <?php foreach ($datasubmenu as $dsa) : ?>
                    <tr>
                      <td><?= $nomor; ?>.</td>
                      <td><?= $dsa['user_sub_menu_title']; ?></td>
                      <td class="td-actions text-right">
                        <?php if ($dsa['is_active'] == 1) : ?>
                          <a href="<?= base_url('manajemen/isaktifsubmenu/') . $this->encryptor->enkrip('enkrip', $dsa['user_sub_menu_id']) . '/' . $this->encryptor->enkrip('enkrip', $dsa['user_menu_id']); ?>" class="btn btn-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Aktif</a>
                        <?php else : ?>
                          <a href="<?= base_url('manajemen/isaktifsubmenu/') . $this->encryptor->enkrip('enkrip', $dsa['user_sub_menu_id']) . '/' . $this->encryptor->enkrip('enkrip', $dsa['user_menu_id']); ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Tidak Aktif</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php $nomor++ ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="3" style="color: red; text-align: center;">Belum Memilih Menu</td>
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