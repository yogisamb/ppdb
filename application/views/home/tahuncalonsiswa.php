<?php if ($orangtua) : ?>
  <section class="my-5 container containers" style="margin-top: -20px;">
    <div class="container">
      <div class="bg-white" id="datasiswa">
        <div class="row">
          <div class="col-8">
            <h3>Data Siswa - Tahun <?= $tahuntitle['tb_tahun_title']; ?></h3>
          </div>
          <div class="col-4">
            <a href="<?= base_url('welcome/tambahcalonsiswa'); ?>" class="btn btn-primary" style="width: 100%;">+&nbsp;&nbsp;&nbsp;Tambah Calon Siswa</a>
          </div>
        </div>
        <hr>
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Data Calon Siswa</th>
              <th>Status</th>
              <th>Informasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($relasianak as $ra) : ?>
              <?php
              $calonsiswa = $this->db->get_where('tb_dataanak', ['tb_dataanak_id' => $ra['tb_dataanak_id']])->row_array();
              $user_provinsi[$nomor] = $this->usr->getUserdataprovinsiuser($calonsiswa['tb_dataanak_provinsi']);
              $user_kabupaten[$nomor] = $this->usr->getUserdatakabupatenkotauser($calonsiswa['tb_dataanak_kabupatenkota']);
              $user_kecamatan[$nomor] = $this->usr->getUserdatakecamatanuser($calonsiswa['tb_dataanak_kecamatan']);
              $user_kelurahan[$nomor] = $this->usr->getUserdatakelurahanuser($calonsiswa['tb_dataanak_kelurahan']);
              $asalsekolah = $this->bj->getSekolah($calonsiswa['tb_dataanak_asal_sekolah']);
              $formjawaban = $this->bj->getJawabanOT($ra['tb_dataanak_id']);
              $cekpembayaran = $this->db->get_where('tb_pembayaran', ['tb_dataanak_id' => $ra['tb_dataanak_id'], 'tb_tahun_id' => $tahun])->row_array();
              $cekpembayaran2 = $this->db->where('tb_pembayaran_file', null);
              $cekpembayaran2 = $this->db->get_where('tb_pembayaran', ['tb_dataanak_id' => $ra['tb_dataanak_id'], 'tb_tahun_id' => $tahun])->row_array();
              $cekjawaban = $this->db->get_where('tb_jawaban', ['tb_dataanak_id' => $ra['tb_dataanak_id']])->result_array();
              ?>
              <tr>
                <td><?= $nomor; ?>.</td>
                <td>
                  <div class="row">
                    <div class="col-md-4">Nama Anak</div>
                    <div class="col-md-8">: <?= $calonsiswa['tb_dataanak_nama_anak']; ?></div>
                    <div class="col-md-4">TTL</div>
                    <div class="col-md-8">: <?= $calonsiswa['tb_dataanak_tempat'] . ', ' . date('d M Y', strtotime($calonsiswa['tb_dataanak_tanggal_lahir'])); ?></div>
                    <div class="col-md-4">Jenis Kelamin</div>
                    <div class="col-md-8">: <?= $calonsiswa['tb_dataanak_jk']; ?></div>
                    <div class="col-md-4">Alamat</div>
                    <div class="col-md-8">: <?= $calonsiswa['tb_dataanak_alamat']; ?></div>
                    <div class="col-md-4">Asal Sekolah</div>
                    <div class="col-md-8">: <?= $asalsekolah['tb_sekolah_title']; ?></div>
                  </div>
                  <hr>
                  <?php if ($cekpembayaran) : ?>
                    <div class="row">
                      <?php if ($cekpembayaran['tb_pembayaran_status'] == 0) : ?>
                        <small>Upload Bukti Pembayaran telah berhasil, <div style="color: red;">Sedang dilakukan Proses validasi oleh admin</div></small>
                      <?php else : ?>
                        <small>Upload Bukti Pembayaran telah berhasil, <div style="color: green;">Dan Telah Divalidasi oleh Admin</div></small>
                      <?php endif; ?>
                      <button onclick="JavaScript:window.location.href='<?= base_url('welcome/downloadbukti/') . $cekpembayaran['tb_pembayaran_file']; ?>'" class="btn btn-primary" style="margin-top: 10px; margin-left: 10px; width: 200px;"><i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;Download Bukti</button>
                    </div>
                    <br>
                  <?php else : ?>
                    <?= form_open_multipart('welcome/uploadpembayaran/' . $this->encryptor->enkrip('enkrip', $tahun) . '/' . $this->encryptor->enkrip('enkrip', $calonsiswa['tb_dataanak_id'])); ?>
                    <div class="row form-group">
                      <div class="col-md-10  mb-3">
                        <label class="form-label form_label" for="message">Upload Bukti Pembayaran</label>
                        <input type="file" id="file" name="file" class="form-control">
                        <?= form_error('file', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="col-md-2  mb-3">
                        <button type="submit" class="btn btn-info" style="color: white; margin-top: 30px; padding-bottom: -20px;"><span class="material-symbols-outlined">save</span></button>
                      </div>
                    </div>
                    </form>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if (!$formjawaban) : ?>
                    <a href="<?= base_url('welcome/uploadformobservasi/' . $this->encryptor->enkrip('enkrip', $calonsiswa['tb_dataanak_id'])); ?>" class="btn btn-info" style="color: white;"><i class="fas fa-upload"></i>&nbsp;&nbsp;&nbsp;Perkembangan</a>
                  <?php else : ?>
                    <?php if ($calonsiswa['tb_dataanak_statusditerima'] == 1) : ?>
                      <h6 class="btn btn-success"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Diterima</h6>
                    <?php else : ?>
                      <h6 class="btn btn-warning"><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Proses</h6>
                    <?php endif; ?>
                    <a href="<?= base_url('welcome/cetakobservasi/') . $this->encryptor->enkrip('enkrip', $calonsiswa['tb_dataanak_id']); ?>" class="btn btn-primary" target="_blank" style="margin-top: 10px;"><i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;Perkembangan</a>
                  <?php endif; ?>
                </td>
                <td>
                  <?= $calonsiswa['tb_dataanak_keterangan_lain']; ?>
                  <?php if ($calonsiswa['tb_dataanak_files']) : ?>
                    <br>
                    <a href="<?= base_url('assets/files/kebutuhankhusus/') . $calonsiswa['tb_dataanak_files']; ?>" target="_blank">Download File</a>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?= base_url('welcome/editcalonsiswa/') . $this->encryptor->enkrip('enkrip', $calonsiswa['tb_dataanak_id']); ?>" class="btn btn-info btn-sm text-white" style="margin-top: 10px;"><span class="material-symbols-outlined">edit</span></a>
                  <br>
                  <?php if ($cekjawaban) : ?>
                    <a href="<?= base_url('welcome/downloadobservasi/') . $this->encryptor->enkrip('enkrip', $calonsiswa['tb_dataanak_id']); ?>" class="btn btn-light" target="_blank" style="margin-top: 10px;"><i class="fas fa-download"></i></a>
                  <?php endif; ?>
                </td>
              </tr>
              <?php $nomor++ ?>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
<?php else : ?>
  <section class="my-5 container containers">
    <div class="container py-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card card_login shadow-lg">
            <div class="card-body p-5">
              <h4 class="mb-12 text-center">Belum Ada Data, Hubungi Admin</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>