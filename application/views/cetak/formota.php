<section class="my-5 container containers">
  <form action="<?= base_url('welcome/simpanformot/' . $this->encryptor->enkrip('enkrip', $dataanak['tb_dataanak_id'])); ?>" method="post" class="p-5 bg-white" enctype="multipart/form-data">
    <div class="card-header py-3">
      <h6>A. Identitas Anak</h6>
    </div>

    <div class="row form-group">
      <div class="col-md-4 mb-3">
        <label class="form-label form_label" for="fname">1. Nama Lengkap Anak</label>
      </div>
      <div class="col-md-8 mb-3">
        <input type="text" class="form-control" value="<?= $dataanak['tb_dataanak_nama_anak']; ?>" readonly>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-4 mb-3">
        <label class="form-label form_label" for="fname">2. Tempat dan Tanggal Lahir</label>
      </div>
      <div class="col-md-4 mb-3">
        <input type="text" class="form-control" value="<?= $dataanak['tb_dataanak_tempat']; ?>" readonly>
      </div>
      <div class="col-md-4 mb-3">
        <input type="text" class="form-control" value="<?= date('d F Y', strtotime($dataanak['tb_dataanak_tanggal_lahir'])); ?>" readonly>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-4 mb-3">
        <label class="form-label form_label" for="fname">3. Jenis Kelamin</label>
      </div>
      <div class="col-md-8 mb-3">
        <input type="text" class="form-control" value="<?= $dataanak['tb_dataanak_jk']; ?>" readonly>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-4 mb-3">
        <label class="form-label form_label" for="fname">4. Agama</label>
      </div>
      <div class="col-md-8 mb-3">
        <input type="text" class="form-control" name="agama" id="agama" placeholder="Agama Anak" value="<?= $dataanak['tb_dataanak_agama']; ?>">
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-4 mb-3">
        <label class="form-label form_label" for="fname">5. Anak Ke</label>
      </div>
      <div class="col-md-3 mb-3">
        <input type="text" class="form-control" placeholder="Anak ke" name="anakke" id="anakke" value="<?= $dataanak['tb_dataanak_anakke']; ?>">
      </div>
      <div class="col-md-2 mb-3">
        <label class="form-label form_label" for="fname">dari jumlah saudara</label>
      </div>
      <div class="col-md-3 mb-3">
        <input type="text" class="form-control" placeholder="Jumlah Sodara" name="jmlsdr" id="jmlsdr" value="<?= $dataanak['tb_dataanak_jmlsdr']; ?>">
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-4 mb-3">
        <label class="form-label form_label" for="fname">6. Alamat Tinggal</label>
      </div>
      <div class="col-md-8 mb-3">
        <input type="text" class="form-control" value="<?= $dataanak['tb_dataanak_alamat']; ?>" readonly>
      </div>
    </div>



    <?php foreach ($formot as $formot) : ?>
      <div class="card-header py-3">
        <h6><?= $formot['tb_observasi_ot_text']; ?></h6>
      </div>
      <?php
      $formotsuper = $this->db->get_where('tb_observasi_ot_super', ['tb_observasi_ot_id' => $formot['tb_observasi_ot_id']])->result_array();
      ?>
      <?php $nomor = 1; ?>
      <?php foreach ($formotsuper as $formotsuper) : ?>
        <?php if ($formotsuper['tb_observasi_ot_super_tipe'] == 1) : ?>
          <?php
          $carijawaban = $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $dataanak['tb_dataanak_id'], 'tb_observasi_ot_super_id' => $formotsuper['tb_observasi_ot_super_id']])->row_array();
          ?>
          <div class="row form-group">
            <div class="col-md-4 mb-3">
              <label class="form-label form_label" for="fname"><?= $nomor; ?>. <?= $formotsuper['tb_observasi_ot_super_text']; ?></label>
            </div>
            <div class="col-md-8 mb-3">
              <input type="text" class="form-control" name="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" id="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" value="<?= $carijawaban['tb_observasi_ot_jawaban_text']; ?>">
            </div>
          </div>
        <?php elseif ($formotsuper['tb_observasi_ot_super_tipe'] == 2) : ?>
          <?php
          $carijawaban = $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $dataanak['tb_dataanak_id'], 'tb_observasi_ot_super_id' => $formotsuper['tb_observasi_ot_super_id']])->row_array();
          ?>
          <div class="row form-group">
            <div class="col-md-4 mb-3">
              <label class="form-label form_label" for="fname"><?= $nomor; ?>. <?= $formotsuper['tb_observasi_ot_super_text']; ?></label>
            </div>
            <div class="col-md-8 mb-3">
              <select class="form-control" name="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" id="<?= $formotsuper['tb_observasi_ot_super_name']; ?>">
                <option value=""> <?= $carijawaban['tb_observasi_ot_jawaban_text']; ?> </option>
                <option value="Normal">Normal</option>
                <option value="Cesar / Sectio">Cesar / Sectio</option>
              </select>
            </div>
          </div>
        <?php elseif ($formotsuper['tb_observasi_ot_super_tipe'] == 3) : ?>
          <?php
          $carijawaban = $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $dataanak['tb_dataanak_id'], 'tb_observasi_ot_super_id' => $formotsuper['tb_observasi_ot_super_id']])->row_array();
          ?>
          <div class="row form-group">
            <div class="col-md-4 mb-3">
              <label class="form-label form_label" for="fname"><?= $nomor; ?>. <?= $formotsuper['tb_observasi_ot_super_text']; ?></label>
            </div>
            <div class="col-md-8 mb-3">
              <input type="text" class="form-control" name="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" id="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" value="<?= $carijawaban['tb_observasi_ot_jawaban_text']; ?>">
            </div>
          </div>
        <?php elseif ($formotsuper['tb_observasi_ot_super_tipe'] == 4) : ?>
          <?php
          $carijawaban = $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $dataanak['tb_dataanak_id'], 'tb_observasi_ot_super_id' => $formotsuper['tb_observasi_ot_super_id']])->row_array();
          ?>
          <div class="row form-group">
            <div class="col-md-4 mb-3">
              <label class="form-label form_label" for="fname"><?= $nomor; ?>. <?= $formotsuper['tb_observasi_ot_super_text']; ?></label>
            </div>
            <div class="col-md-1 mb-3">
              <label class="form-label form_label" for="fname">Umur</label>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" class="form-control" name="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" id="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" value="<?= $carijawaban['tb_observasi_ot_jawaban_text']; ?>">
            </div>
            <div class="col-md-1 mb-3">
              <label class="form-label form_label" for="fname">Tahun</label>
            </div>
          </div>
        <?php elseif ($formotsuper['tb_observasi_ot_super_tipe'] == 5) : ?>
          <?php
          $carijawaban = $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $dataanak['tb_dataanak_id'], 'tb_observasi_ot_super_id' => $formotsuper['tb_observasi_ot_super_id']])->row_array();
          ?>
          <div class="row form-group">
            <div class="col-md-4 mb-3">
              <label class="form-label form_label" for="fname"><?= $nomor; ?>. <?= $formotsuper['tb_observasi_ot_super_text']; ?></label>
            </div>
            <div class="col-md-7 mb-3">
              <input type="text" class="form-control" name="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" id="<?= $formotsuper['tb_observasi_ot_super_name']; ?>" value="<?= $carijawaban['tb_observasi_ot_jawaban_text']; ?>">
            </div>
            <div class="col-md-1 mb-3">
              <label class="form-label form_label" for="fname">Tahun</label>
            </div>
          </div>
        <?php else : ?>
          <?php
          $asalsekolah = $this->bj->getSekolah($dataanak['tb_dataanak_asal_sekolah']);
          ?>
          <div class="row form-group">
            <div class="col-md-4 mb-3">
              <label class="form-label form_label" for="fname"><?= $nomor; ?>. <?= $formotsuper['tb_observasi_ot_super_text']; ?></label>
            </div>
            <div class="col-md-8 mb-3">
              <input type="text" class="form-control" value="<?= $asalsekolah['tb_sekolah_title']; ?>" readonly>
            </div>
          </div>
        <?php endif; ?>
        <?php $nomor++; ?>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </form>
</section>