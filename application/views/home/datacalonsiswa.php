<?php if ($orangtua) : ?>
  <section class="my-5 container containers" style="margin-top: 50px;">
    <div class="container">
      <div class="p-5 bg-white">
        <div class="row">
          <div class="col-md-12">
            <form action="<?= base_url('welcome/editorangtua/'); ?>" method="post">
              <div class="row form-group mb-3">
                <div class="col-md-4">Nama Ayah</div>
                <div class="col-md-8"><input type="text" class="form-control" name="namaayah" id="namayah" value="<?= $orangtua['tb_dataanak_nama_ayah']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-md-4">Pekerjaan Ayah</div>
                <div class="col-md-8"><input type="text" class="form-control" name="pekerjaanayah" id="pekerjaanayah" value="<?= $orangtua['tb_dataanak_pekerjaan_ayah']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-md-4">Telp Ayah</div>
                <div class="col-md-8"><input type="text" class="form-control" name="telpayah" id="telpayah" value="<?= $orangtua['tb_dataanak_telp_ayah']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-md-4">Umur Ayah</div>
                <div class="col-md-2"><input type="text" class="form-control" name="umurayah" id="umurayah" value="<?= date('Y') - $orangtua['tb_dataanak_umur_ayah']; ?>" readonly></div>
                <div class="col-md-2">Tahun Lahir Ayah</div>
                <div class="col-md-4"><input type="text" class="form-control" name="umurayah" id="umurayah" value="<?= $orangtua['tb_dataanak_umur_ayah']; ?>"></div>
              </div>
              <div class="row form-group mb-3" style="margin-top: 15px;">
                <div class="col-md-4">Nama Ibu</div>
                <div class="col-md-8"><input type="text" class="form-control" name="namaibu" id="namibu" value="<?= $orangtua['tb_dataanak_nama_ibu']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-md-4">Pekerjaan Ibu</div>
                <div class="col-md-8"><input type="text" class="form-control" name="pekerjaanibu" id="pekerjaanibu" value="<?= $orangtua['tb_dataanak_pekerjaan_ibu']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-md-4">Telp Ibu</div>
                <div class="col-md-8"><input type="text" class="form-control" name="telpibu" id="telpibu" value="<?= $orangtua['tb_dataanak_telp_ibu']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-md-4">Umur Ibu</div>
                <div class="col-md-2"><input type="text" class="form-control" name="umuribu" id="umuribu" value="<?= date('Y') - $orangtua['tb_dataanak_umur_ibu']; ?>" readonly></div>
                <div class="col-md-2">Tahub Lahir Ibu</div>
                <div class="col-md-4"><input type="text" class="form-control" name="umuribu" id="umuribu" value="<?= $orangtua['tb_dataanak_umur_ibu']; ?>"></div>
              </div>
              <div class="row form-group mb-3">
                <button type="submit" class="btn btn-primary btn-md text-white">&nbsp;&nbsp;&nbsp;Edit Data Orang Tua</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="my-5 container containers" style="margin-top: -20px;">
    <div class="container">
      <div class="bg-white" id="datasiswa">
        <div class="row">
          <div class="col-12">
            <h3>Data Tahun Masuk</h3>
          </div>

        </div>
        <hr>
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Tahun Masuk</th>
              <th style="text-align: right;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $nomora = 1; ?>
            <?php foreach ($tahun as $tahun) : ?>
              <?php
              $user = $this->usr->getUserlog();
              $cektahunaktif = $this->bj->getTahunaktifrow();
              echo '<pre>';
              ?>
              <tr>
                <td><?= $nomora; ?>.</td>
                <td><?= $tahun['tb_tahun_title']; ?></td>
                <td style="text-align: right;">
                  <a href="<?= base_url('welcome/tahuncalonsiswa/') . $this->encryptor->enkrip('enkrip', $tahun['tb_tahun_id']); ?>" class="btn btn-info btn-sm text-white">Data Anak</a>
                </td>
              </tr>
              <?php $nomora++ ?>
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