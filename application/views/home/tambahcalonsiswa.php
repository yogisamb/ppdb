<section class="my-5 container containers">
  <h2 class="text-center mb-4">Pendaftaran Peserta Didik Baru</h2>
  <form action="<?= base_url('welcome/tambahcalonsiswa'); ?>" method="post" enctype="multipart/form-data">
    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="text-black" for="fname">Nama Lengkap Anak</label>
        <input type="text" id="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap Anak" value="<?= set_value('namalengkap'); ?>">
        <?= form_error('namalengkap', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">

      <div class="col-md-12 mb-3">
        <label class="text-black" for="email">Tempat Tanggal Lahir Anak</label>
        <div class="row">
          <div class="col-md-6"><input type="text" id="t" name="t" class="form-control" placeholder="Tempat Lahir" value="<?= set_value('t'); ?>"><?= form_error('t', '<small class="text-danger pl-3">', '</small>'); ?></div>
          <div class="col-md-6"><input type="date" id="tl" name="tl" class="form-control" value="<?= set_value('l'); ?>"> <?= form_error('tl', '<small class="text-danger pl-3">', '</small>'); ?></div>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="text-black" for="subject">Jenis Kelamin</label>
        <select name="jk" id="jk" class="form-control">
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
          <option value=""> -- Data Sekolah -- </option>
          <option value="pilihsekolah"> Isi Manual Nama Sekolah </option>
          <?php foreach ($sekolah as $s) : ?>
            <option value="<?= $s['tb_sekolah_id']; ?>"><?= $s['tb_sekolah_title']; ?></option>
          <?php endforeach ?>
        </select>
        <?= form_error('asalsekolah', '<small class="text-danger pl-3">', '</small>'); ?>
        <div class="col-md-12" id="filebaru">
          <input type="hidden" id="manual" name="manual" class="form-control" style="margin-top: 10px;" placeholder="Nama Sekolah">
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">Alamat Tempat Tinggal</label>
        <textarea id="alamat" name="alamat" cols="30" rows="7" class="form-control" placeholder="Alamat"><?= set_value('alamat'); ?></textarea>
        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-6">
            <select name="provinsi" id="provinsi" class="form-control">
              <option value=""> -- Silahkan Pilih Provinsi -- </option>
              <?php foreach ($provinsi as $p) : ?>
                <option value="<?= $p['id_provinsi']; ?>"><?= $p['name']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <select id="kotakabupaten" name="kotakabupaten" class="form-control">
              <option value=""> -- Pilih Kabupaten Kota -- </option>
            </select>
            <?= form_error('kotakabupaten', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-6">
            <select name="kecamatan" id="kecamatan" class="form-control">
              <option value=""> -- Pilih Kecamatan -- </option>
            </select>
            <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-md-6">
            <select name="kelurahan" id="kelurahan" class="form-control">
              <option value=""> -- Pilih Kelurahan -- </option>
            </select>
            <?= form_error('kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="email">Jadwal Touring School</label>
        <input type="date" id="jadwal" name="jadwal" class="form-control" placeholder="Jadwal Touring School" value="<?= set_value('jadwal'); ?>"> <?= form_error('jadwal', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="text-black" for="message">Keterangan Lain</label>
        <textarea id="keterangan_lain" name="keterangan_lain" cols="30" rows="7" class="form-control" placeholder="(informasi jika Anak Berkebutuhan Khusus dan diagnosa dari psikolog atau yang berkompeten)"><?= set_value('keterangan_lain'); ?></textarea>
        <?= form_error('keterangan_lain', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12  mb-3">
        <label class="form-label form_label" for="message">File Note Anak Berkebutuhan Khusus (PDF) Kosongkan jika tidak ada</label>
        <input type="file" id="file" name="file" class="form-control">
        <?= form_error('keterangan_lain', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="text-black" for="fname">Darimana Ayah Bunda memperoleh informasi PPDB SD Islam Bintang Juara?</label>
        <input type="text" id="informasi" name="informasi" class="form-control" placeholder="Darimana Ayah Bunda memperoleh informasi PPDB SD Islam Bintang Juara?" value="<?= set_value('informasi'); ?>">
        <?= form_error('informasi', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <label class="text-black" for="message">Pertanyaan Seputar PPDB</label>
        <textarea id="keterangan" name="keterangan" cols="30" rows="7" class="form-control" placeholder="Pertanyaan seputar PPDB TP.2023-2024 SD Islam Bintang Juara."><?= set_value('keterangan'); ?></textarea>
        <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-12 mb-3">
        <button type="submit" class="btn btn-primary btn-md text-white">Kirim</button>
      </div>
    </div>
  </form>
</section>