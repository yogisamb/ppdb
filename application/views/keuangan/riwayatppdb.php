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
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered no-wrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Anak</th>
                  <th>Nama Orang Tua</th>
                  <th>Status Pembayaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($datappdb as $ppdb) : ?>
                  <?php
                  $datauser =  $this->usr->getUser($ppdb['user_id']);
                  $dataanak = $this->bj->getDataanak($ppdb['tb_dataanak_id']);
                  $datawali = $this->bj->getWalisiswa($ppdb['user_id']);
                  ?>
                  <tr>
                    <td><?= $i; ?>.</td>
                    <td>
                      <b><?= $dataanak['tb_dataanak_nama_anak']; ?></b>
                    </td>
                    <td><?= $datauser['user_name']; ?></td>
                    <td>
                      <?php if ($ppdb['tb_pembayaran_file']) : ?>
                        <?php if ($ppdb['tb_pembayaran_status'] == 0) : ?>
                          <div style="color: red">Belum Dilakukan Validasi Pembayaran</div>
                        <?php else : ?>
                          <div style="color: green">Sudah dilakukan Validasi</div>
                        <?php endif; ?>
                        <button onclick="JavaScript:window.location.href='<?= base_url('keuangan/downloadbukti/') . $ppdb['tb_pembayaran_file']; ?>'" class="btn btn-primary" style="margin-top: 10px;"><i class="fas fa-download"></i></button>
                        <a href="<?= base_url('assets/files/pembayaran/') . $ppdb['tb_pembayaran_file']; ?>" class="btn btn-warning" target="_blank" style="margin-top: 10px;"><i class="fas fa-eye"></i></a>
                      <?php else : ?>
                        <div style="color: red; text-align: red;">Belum Melakukan Pembayaran</div>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="https://wa.me/<?= $datawali['tb_dataanak_telp_ayah']; ?>" class="btn btn-info" target="_blank"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;&nbsp;<?= $datawali['tb_dataanak_telp_ayah']; ?></a>
                      <?php if ($ppdb['tb_pembayaran_file']) : ?>
                        <?php if ($ppdb['tb_pembayaran_status'] == 0) : ?>
                          <br>
                          <a href="#" class="btn btn-rounded btn-outline-success" style="margin-top: 10px;" data-toggle="modal" data-target="#lock<?= $i; ?>"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Validasi</a>
                          <div class="modal fade" id="lock<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Passowrd</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="<?= base_url('keuangan'); ?>" method="post">
                                  <div class="modal-body">
                                    <input type="hidden" value="<?= $this->encryptor->enkrip('enkrip', $datawali['user_id']); ?>" name="idwali">
                                    <input type="hidden" value="<?= $this->encryptor->enkrip('enkrip', $ppdb['tb_pembayaran_id']); ?>" name="id">
                                    <input type="password" class="form-control" style="margin: 0;" name="password">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Validasi</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>
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