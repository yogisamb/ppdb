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
          <h4 class="card-title"><?= $submenu ?></h4>
          <hr>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Data User</th>
                  <th>Posisi</th>
                  <th style="text-align: right;">Aksi</th>
                </tr>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; ?>
                <?php foreach ($datauser as $du) : ?>
                  <tr>
                    <td><?= $nomor; ?>.</td>
                    <td>
                      <img src="<?= base_url('assets/images/user_profile/') . $du['user_image']; ?>" alt="" style="width: 50px;">
                    </td>
                    <td>
                      Username : <?= $du['user_name']; ?>
                      <br>
                      Email : <?= $du['user_email']; ?>
                      <br>
                      <?php if ($du['is_active'] == 1) : ?>
                        Status Akun : <a href="<?= base_url('admin/isaktifuser/') . $this->encryptor->enkrip('enkrip', $du['user_id']); ?>" class="badge badge-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Aktif</a>
                      <?php else : ?>
                        Status Akun : <a href="<?= base_url('admin/isaktifuser/') . $this->encryptor->enkrip('enkrip', $du['user_id']); ?>" class="badge badge-danger"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;&nbsp;Suspend</a>
                      <?php endif; ?>
                    </td>
                    <td class="td-actions text-center">
                      <?php if ($du['user_id'] == 1) : ?>
                        <h6 style="text-align: center;">Saya Developernya Boskuh!</h6>
                      <?php else : ?>
                        <form action="<?= base_url('admin/ubahrolemaster/'); ?>" method="post">
                          <input type="hidden" name="id" id="id" value="<?= $du['user_id']; ?>">
                          <?php
                          $jobdesk[$nomor] = $this->sis->getRole($du['user_role_id']);
                          ?>
                          <select name="jobdesk" id="jobdesk" class="form-control">
                            <option value="<?= $jobdesk[$nomor]['user_role_id']; ?>"><?= $jobdesk[$nomor]['user_role_title'] ?></option>
                            <?php foreach ($role as $r) : ?>
                              <option value="<?= $r['user_role_id']; ?>"><?= $r['user_role_title'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <button class="btn btn-success" style="margin-top: 5px;"> <i class="fas fa-save"></i></button>
                        </form>
                      <?php endif ?>
                    </td>
                    <td class="text-right">
                      <a href="#" class="btn btn-info" data-toggle="modal" data-target="#lock<?= $nomor; ?>"><i class="fas fa-lock"></i></a>
                      <div class="modal fade" id="lock<?= $nomor; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Passowrd</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="<?= base_url('admin'); ?>" method="post">
                              <div class="modal-body">
                                <input type="hidden" value="<?= $this->encryptor->enkrip('enkrip', $du['user_id']); ?>" name="id">
                                <input type="password" class="form-control" style="margin: 0;" name="password">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success"> <i class="fas fa-eye"></i></button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php $nomor++ ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-5">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="text-align: center;">Data Detail User</h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <?php if ($profile != null) : ?>
            <h3 class="profile-username text-center"><?= $profile['user_name']; ?></h3>

            <p class="text-muted text-center">
              <?php
              $jobdesk = $this->sis->getRole($profile['user_role_id']);
              echo $jobdesk['user_role_title'];
              ?>
            </p>
            <p class="text-muted text-center">
              <?php
              $password = $this->encryptor->enkrip('dekrip', $profile['user_password_mask']);
              echo 'Password&nbsp;:&nbsp;' . $password;
              ?>
            </p>
          <?php else : ?>
            <h6 class="profile-username text-center">Belum Memilih Profile</h6>
          <?php endif; ?>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambah User</h4>
          <hr>
          <form action="<?= base_url('admin/tambahuser'); ?>" method="POST">
            <div class="form-group">
              <div class="row">
                <label class="col-md-3 text-left">Email </label>
                <div class="col-md-9">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Tuliskan Email Di Sini" value="<?= set_value('email'); ?>">
                  <div id="hasilemail" class="form-text">
                    <p style="color: gray; font-size: 10px;">Email Tidak Boleh Kosong</p>
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-md-3 text-left">Username </label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Tuliskan Username Di Sini" value="<?= set_value('username'); ?>">
                  <div id="hasilusername" class="form-text">
                    <p style="color: gray; font-size: 10px;">Username Tidak Boleh Kosong</p>
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>
            </div>
            <?php $role1 = $this->sis->getRole(); ?>
            <div class="form-group">
              <div class="row">
                <label class="col-md-3 text-left">Role User </label>
                <div class="col-md-9">
                  <select name="role" id="role" class="form-control form-control-round">
                    <option value="">-- Silahkan Pilih --</option>
                    <?php foreach ($role1 as $r1) : ?>
                      <option value="<?= $r1['user_role_id']; ?>"><?= $r1['user_role_title'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-md-3 text-left">Password </label>
                <div class="col-md-6">
                  <input type="text" class="form-control form-control-round" id="password" name="password" placeholder="Password">
                  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="col-md-3">
                  <a href="#" class="btn btn-info" id="randompassword" style="width: 100%;"> <i class="fas fa-random"></i></a>
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