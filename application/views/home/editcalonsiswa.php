<section class="my-5 container containers">
  <h2 class="text-center mb-4">Edit Peserta Didik <?= $calonsiswa['tb_dataanak_nama_anak']; ?></h2>
  <form action="<?= base_url('welcome/editcalonsiswa/') . $this->encryptor->enkrip('enkrip', $calonsiswa['tb_dataanak_id']); ?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
      <div class="col-md-12 mb-3 ">
        <label class="form-label form_label" for="fname">Nama Lengkap Anak</label>
        <input type="text" id="namalengkap" name="namalengkap" class="form-control" value="<?= $calonsiswa['tb_dataanak_nama_anak']; ?>">
        <?= form_error('namalengkap', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">

      <div class="col-md-12 mb-3">
        <label class="form-label form_label" for="email">Tempat Tanggal Lahir Anak</label>
        <div class="row">
          <div class="col-md-6"><input type="text" id="t" name="t" class="form-control" value="<?= $calonsiswa['tb_dataanak_tempat']; ?>"><?= form_error('t', '<small class="text-danger pl-3">', '</small>'); ?></div>
          <div class="col-md-6"><input type="date" id="tl" name="tl" class="form-control" value="<?= $calonsiswa['tb_dataanak_tanggal_lahir']; ?>"> <?= form_error('tl', '<small class="text-danger pl-3">', '</small>'); ?></div>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="form-label form_label" for="subject">Jenis Kelamin</label>
        <select name="jk" id="jk" class="form-control">
          <option value="<?= $calonsiswa['tb_dataanak_jk']; ?>"><?= $calonsiswa['tb_dataanak_jk']; ?></option>
          <option value="Laki - Laki">Laki - Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">Asal Sekolah</label>
        <select name="asalsekolah" id="asalsekolah" class="form-control">
          <option value="<?= $asalsekolah['tb_sekolah_id']; ?>"><?= $asalsekolah['tb_sekolah_title']; ?></option>
          <?php foreach ($sekolah as $s) : ?>
            <option value="<?= $s['tb_sekolah_id']; ?>"><?= $s['tb_sekolah_title']; ?></option>
          <?php endforeach ?>
        </select>
        <?= form_error('asalsekolah', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="form-label form_label" for="message">Alamat Tempat Tinggal</label>
        <textarea id="alamat" name="alamat" cols="30" rows="7" class="form-control"><?= $calonsiswa['tb_dataanak_alamat']; ?></textarea>
        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
        <?php
        $user_provinsi = $this->usr->getUserdataprovinsiuser($calonsiswa['tb_dataanak_provinsi']);
        $user_kabupaten = $this->usr->getUserdatakabupatenkotauser($calonsiswa['tb_dataanak_kabupatenkota']);
        $user_kecamatan = $this->usr->getUserdatakecamatanuser($calonsiswa['tb_dataanak_kecamatan']);
        $user_kelurahan = $this->usr->getUserdatakelurahanuser($calonsiswa['tb_dataanak_kelurahan']);
        ?>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-6">
            <select name="provinsi" id="provinsi" class="form-control">
              <?php if ($calonsiswa['tb_dataanak_provinsi'] == 0) : ?>
                <option value=""> -- Silahkan Pilih Provinsi -- </option>
              <?php else : ?>
                <option value="<?= $calonsiswa['tb_dataanak_provinsi']; ?>"><?= $user_provinsi['name']; ?></option>
              <?php endif ?>
              <?php foreach ($provinsi as $p) : ?>
                <option value="<?= $p['id_provinsi']; ?>"><?= $p['name']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <select id="kotakabupaten" name="kotakabupaten" class="form-control">
              <option value="<?= $calonsiswa['tb_dataanak_kabupatenkota']; ?>"><?= $user_kabupaten['name']; ?></option>
            </select>
            <?= form_error('kotakabupaten', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-6">
            <select name="kecamatan" id="kecamatan" class="form-control">
              <option value="<?= $calonsiswa['tb_dataanak_kecamatan']; ?>"><?= $user_kecamatan['name']; ?></option>
            </select>
            <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <select name="kelurahan" id="kelurahan" class="form-control">
              <option value="<?= $calonsiswa['tb_dataanak_kecamatan']; ?>"><?= $user_kecamatan['name']; ?></option>
            </select>
            <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="email">Jadwal Touring School</label>
        <input type="date" id="jadwal" name="jadwal" class="form-control" value="<?= $calonsiswa['tb_dataanak_jadwal']; ?>"> <?= form_error('jadwal', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="form-label form_label" for="message">(informasi jika Anak Berkebutuhan Khusus dan diagnosa dari psikolog atau yang berkompeten)</label>
        <textarea id="keterangan_lain" name="keterangan_lain" cols="30" rows="7" class="form-control"><?= $calonsiswa['tb_dataanak_keterangan_lain']; ?></textarea>
        <?= form_error('keterangan_lain', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">File Note Anak Berkebutuhan Khusus (PDF) Kosongkan jika tidak ada</label>
        <div class="row">
          <div class="col-3">
            <a href="<?= base_url('assets/files/kebutuhankhusus/') . $calonsiswa['tb_dataanak_files']; ?>">Download File</a>
          </div>
          <div class="col-9">
            <input type="file" id="file" name="file" class="form-control">
          </div>
        </div>
        <?= form_error('keterangan_lain', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <button type="submit" class="btn btn-primary btn-md text-white">edit</button>
      </div>
    </div>
  </form>
</section>