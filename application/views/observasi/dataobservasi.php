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
                  <th>#</th>
                  <th>Data Anak</th>
                  <th>Touring School</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($dataanak as $anak) : ?>
                  <?php
                  $datawali = $this->bj->getWalibyanak($anak['tb_dataanak_id']);
                  $cekpembayaran = $this->db->get_where('tb_pembayaran', ['tb_dataanak_id' => $anak['tb_dataanak_id']])->row_array();
                  $user_provinsi = $this->usr->getUserdataprovinsiuser($anak['tb_dataanak_provinsi']);
                  $user_kabupaten = $this->usr->getUserdatakabupatenkotauser($anak['tb_dataanak_kabupatenkota']);
                  $user_kecamatan = $this->usr->getUserdatakecamatanuser($anak['tb_dataanak_kecamatan']);
                  $user_kelurahan = $this->usr->getUserdatakelurahanuser($anak['tb_dataanak_kelurahan']);
                  $cekjawaban = $this->db->get_where('tb_jawaban', ['tb_dataanak_id' => $ra['tb_dataanak_id']])->result_array();
                  ?>
                  <?php if ($cekpembayaran) : ?>
                    <?php if ($cekpembayaran['tb_pembayaran_status'] == 1) : ?>
                      <tr>
                        <td><?= $i; ?>.</td>
                        <td>
                          <b><?= $anak['tb_dataanak_nama_anak']; ?></b>
                          <br>
                          Wali : <?= $datawali['tb_dataanak_nama_ayah']; ?>
                          <div style="margin-top: 10px;">
                            <b>Alamat :</b>
                            <br>
                            <?= $anak['tb_dataanak_alamat']; ?>, <?= $user_kelurahan['name']; ?>, <?= $user_kecamatan['name']; ?>, <br> <?= $user_kabupaten['name']; ?>, <?= $user_provinsi['name']; ?>
                          </div>
                          <div style="margin-top: 10px;">
                            <b>Kebutuhan Khusus :</b>
                            <br>
                            <?= $anak['tb_dataanak_keterangan_lain']; ?>
                            <?php if ($anak['tb_dataanak_files']) : ?>
                              <br>
                              <a href="<?= base_url('assets/files/kebutuhankhusus/') . $anak['tb_dataanak_files']; ?>" target="_blank">Download File</a>
                            <?php endif; ?>
                            <hr>
                            <a href="https://wa.me/<?= $datawali['tb_dataanak_telp_ayah']; ?>" class="btn btn-info" target="_blank" style="margin-top: 10px;"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;&nbsp;<?= $datawali['tb_dataanak_telp_ayah']; ?></a>
                            <a href="<?= base_url('observasi/downloadobservasiot/') . $this->encryptor->enkrip('enkrip', $anak['tb_dataanak_id']); ?>" class="btn btn-light" target="_blank" style="margin-top: 10px;"><i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;Form PA</a>
                          </div>
                        </td>
                        <td style="text-align: center;">
                          <?php if ($anak['tb_dataanak_statusditerima'] == 0) : ?>
                            <form action="<?= base_url('observasi/index/') . $this->encryptor->enkrip('enkrip', $anak['tb_dataanak_id']); ?>" method="POST">
                              <label for="date"><?= date('l', strtotime($anak['tb_dataanak_jadwal'])); ?></label>
                              <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime($anak['tb_dataanak_jadwal'])); ?>" name="date" id="date">
                              <button type="submit" class="btn btn-warning" style="margin-top: 10px; width: 100%;"><i class="fas fa-edit"></i>&nbsp;&nbsp;&nbsp;Ubah Hari</button>
                            </form>
                          <?php else : ?>
                            <h4 class="btn btn-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Siswa Telah Diterima</h4>
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="<?= base_url('observasi/formobservasi/') . $this->encryptor->enkrip('enkrip', $anak['tb_dataanak_id']); ?>" class="btn btn-orange" style="color: white;" target="_blank"><i class="fab fa-wpforms"></i></a>
                          <?php if ($cekjawaban) : ?>
                            <a href="<?= base_url('observasi/downloadobservasi/') . $this->encryptor->enkrip('enkrip', $anak['tb_dataanak_id']); ?>" class="btn btn-light" target="_blank"><i class="fas fa-download"></i></a>
                            <!-- <a href="#" class="btn btn-success" target="_blank"><i class="fas fa-eye"></i></a> -->
                          <?php endif; ?>
                          <?php if ($anak['tb_dataanak_statusditerima'] == 0) : ?>
                            <br>
                            <a href="<?= base_url('observasi/siswaditerima/') . $this->encryptor->enkrip('enkrip', $anak['tb_dataanak_id']); ?>" class="btn btn-info" style="margin-top: 10px;"><i class="fas fa-check-square"></i>&nbsp;&nbsp;&nbsp;Terima</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>