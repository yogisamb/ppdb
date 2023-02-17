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
          <form action="<?= base_url('observasi/editnama/') . $this->encryptor->enkrip('enkrip', $dataanak['tb_dataanak_id']); ?>" method="post">
            <div class="row form-group">
              <label for="text" class="col-sm-2 card-title">Nama Lengkap</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="<?= $dataanak['tb_dataanak_nama_anak']; ?>" disabled>
              </div>
            </div>
            <div class="row form-group">
              <label for="text" class="col-sm-2 card-title">Nama Panggilan</label>
              <div class="col-sm-4">
                <?php if ($dataanak['tb_dataanak_nama_panggilan']) : ?>
                  <input type="text" class="form-control" value="<?= $dataanak['tb_dataanak_nama_panggilan']; ?>" name="panggilan" id="panggilan">
                <?php else : ?>
                  <input type="text" class="form-control" placeholder="Nama Panggilan" name="panggilan" id="panggilan">
                <?php endif; ?>
              </div>
              <div class="col-sm-2">
                <button class="btn btn-success" style="width: 100%;"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan</button>
              </div>
            </div>
            <div class="row form-group">
              <label for="text" class="col-sm-2 card-title">Tanggal Lahir</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="<?= date('d M Y', strtotime($dataanak['tb_dataanak_tanggal_lahir'])); ?>" disabled>
              </div>
            </div>
            <div class="row form-group">
              <label for="text" class="col-sm-2 card-title">Jadwal Touring</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="<?= date('l, d M Y', strtotime($dataanak['tb_dataanak_jadwal'])); ?>" disabled>
              </div>
            </div>
            <div class="row form-group">
              <label for="text" class="col-sm-2 card-title">Umur Anak</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" value="<?= date('Y') - date('Y', strtotime($dataanak['tb_dataanak_tanggal_lahir'])); ?> TAHUN" disabled>
              </div>
            </div>
          </form>
          <hr>
          <?php foreach ($dataobservasi as $observasi) : ?>
            <?php
            $subobservasi = $this->obs->getSubobservasibyobservasiid($observasi['tb_observasi_id']);
            ?>
            <h4 style="margin-top: 20px; color: black;"><?= $observasi['tb_observasi_title']; ?></h4>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sub Observasi</th>
                    <th scope="col">Penagamatan</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Asksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $nomor = 1; ?>
                  <?php foreach ($subobservasi as $subobservasi) : ?>
                    <?php
                    $supersubobservasi = $this->obs->getSupersubobservasibysubobservasiid($subobservasi['tb_observasi_sub_id']);
                    ?>
                    <?php if ($supersubobservasi) : ?>
                      <tr>
                        <th scope="row"><?= $nomor; ?>.</th>
                        <td style="font-weight: 500;"><?= $subobservasi['tb_observasi_sub_title']; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <?php foreach ($supersubobservasi as $supersub) : ?>
                        <?php
                        $jawabansatu = $this->obs->getJawabansuper($supersub['tb_observasi_sub_super_id'], $dataanak['tb_dataanak_id']);
                        ?>
                        <tr>
                          <th scope="row"></th>
                          <td><?= $supersub['tb_observasi_sub_super_title']; ?></td>
                          <form action="<?= base_url('observasi/jawabansupersub/') . $this->encryptor->enkrip('enkrip', $supersub['tb_observasi_sub_super_id']) . '/' . $this->encryptor->enkrip('enkrip', $dataanak['tb_dataanak_id']); ?>" method="POST">
                            <td>
                              <select name="nilai" id="nilai" class="form-control">
                                <?php if ($jawabansatu) : ?>
                                  <?php $nilaiku = $this->obs->getNilai($jawabansatu['tb_jawaban_nilai']); ?>
                                  <option value="<?= $jawabansatu['tb_jawaban_id']; ?>"> <?= $nilaiku['tb_nilai_title']; ?> </option>
                                <?php else : ?>
                                  <option value=""> -- Pilih Nilai -- </option>
                                <?php endif; ?>
                                <?php foreach ($nilai as $n) : ?>
                                  <option value="<?= $n['tb_nilai_id']; ?>"> <?= $n['tb_nilai_title']; ?> </option>
                                <?php endforeach ?>
                              </select>
                            </td>
                            <td>
                              <?php if ($jawabansatu) : ?>
                                <input type="text" name="catatan" id="catatan" class="form-control" value="<?= $jawabansatu['tb_jawaban_catatan']; ?>">
                              <?php else : ?>
                                <input type="text" name="catatan" id="catatan" class="form-control" placeholder="Catatan">
                              <?php endif; ?>
                            </td>
                            <td><button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan</button></td>
                          </form>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <?php
                      $jawabandua = $this->obs->getJawabansub($subobservasi['tb_observasi_sub_id'], $dataanak['tb_dataanak_id']);
                      ?>
                      <tr>
                        <th scope="row"><?= $nomor; ?>.</th>
                        <td style="font-weight: 500;"><?= $subobservasi['tb_observasi_sub_title']; ?></td>
                        <form action="<?= base_url('observasi/jawabansub/') . $this->encryptor->enkrip('enkrip', $subobservasi['tb_observasi_sub_id']) . '/' . $this->encryptor->enkrip('enkrip', $dataanak['tb_dataanak_id']); ?>" method="POST">
                          <td>
                            <select name="nilai" id="nilai" class="form-control">
                              <?php if ($jawabandua) : ?>
                                <?php $nilaiku = $this->obs->getNilai($jawabandua['tb_jawaban_nilai']); ?>
                                <option value="<?= $jawabandua['tb_jawaban_id']; ?>"> <?= $nilaiku['tb_nilai_title']; ?> </option>
                              <?php else : ?>
                                <option value=""> -- Pilih Nilai -- </option>
                              <?php endif; ?>
                              <?php foreach ($nilai as $n) : ?>
                                <option value="<?= $n['tb_nilai_id']; ?>"> <?= $n['tb_nilai_title']; ?> </option>
                              <?php endforeach ?>
                            </select>
                          </td>
                          <td>
                            <?php if ($jawabandua) : ?>
                              <input type="text" name="catatan" id="catatan" class="form-control" value="<?= $jawabandua['tb_jawaban_catatan']; ?>">
                            <?php else : ?>
                              <input type="text" name="catatan" id="catatan" class="form-control" placeholder="Catatan">
                            <?php endif; ?>
                          </td>
                          <td><button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp;Simpan</button></td>
                        </form>
                      </tr>
                    <?php endif ?>
                    <?php $nomor++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>