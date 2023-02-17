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
                  <th>Nama Anak</th>
                  <th>Touring School</th>
                  <th>Alamat Siswa</th>
                  <th>Kebutuhan Khusus</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($datappdb as $ppdb) : ?>
                  <?php
                  $datawali = $this->bj->getWalisiswa($ppdb['user_id']);
                  $dataanak = $this->bj->getDataanak($ppdb['tb_dataanak_id']);
                  $user_provinsi = $this->usr->getUserdataprovinsiuser($dataanak['tb_dataanak_provinsi']);
                  $user_kabupaten = $this->usr->getUserdatakabupatenkotauser($dataanak['tb_dataanak_kabupatenkota']);
                  $user_kecamatan = $this->usr->getUserdatakecamatanuser($dataanak['tb_dataanak_kecamatan']);
                  $user_kelurahan = $this->usr->getUserdatakelurahanuser($dataanak['tb_dataanak_kelurahan']);
                  ?>
                  <tr>
                    <td><?= $i; ?>.</td>
                    <td><b><?= $dataanak['tb_dataanak_nama_anak']; ?></b> <br> Wali : <?= $datawali['tb_dataanak_nama_ayah']; ?></td>
                    <td><?= date('D, d M Y', strtotime($dataanak['tb_dataanak_jadwal'])); ?></td>
                    <td><?= $dataanak['tb_dataanak_alamat']; ?>, <?= $user_kelurahan['name']; ?>, <?= $user_kecamatan['name']; ?>, <br> <?= $user_kabupaten['name']; ?>, <?= $user_provinsi['name']; ?> <br><a href="https://wa.me/<?= $datawali['tb_dataanak_telp_ayah']; ?>" class="btn btn-info" target="_blank" style="margin-top: 10px;"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;&nbsp;<?= $datawali['tb_dataanak_telp_ayah']; ?></a></td>
                    <td>
                      <?= $dataanak['tb_dataanak_keterangan_lain']; ?>
                      <?php if ($dataanak['tb_dataanak_files']) : ?>
                        <br>
                        <a href="<?= base_url('assets/files/kebutuhankhusus/') . $dataanak['tb_dataanak_files']; ?>" target="_blank">Download File</a>
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